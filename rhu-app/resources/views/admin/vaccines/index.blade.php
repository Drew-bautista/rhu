@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6">Vaccine Records</h1>
                        <a href="{{ route('admin.vaccines.create') }}" class="btn btn-primary btn-sm">
                            Add Vaccine Record
                        </a>
                    </div>
                </div>
                {{-- Search bar --}}
                <x-searchBar placeholder="Search vaccine records..." />
            </div>
        </div>

        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-hover" id="vaccineTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-light">
                            <th>Patient Name</th>
                            <th>Age Group</th>
                            <th>Vaccine Type</th>
                            <th>Dose</th>
                            <th>Date Administered</th>
                            <th>Next Dose</th>
                            <th>Administered By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="vaccineTableBody">
                        @forelse($vaccines as $vaccine)
                            <tr>
                                <td>{{ $vaccine->patient_name }}</td>
                                <td>
                                    @if($vaccine->age_group == 'infant')
                                        <span class="badge bg-info">Infant</span>
                                    @elseif($vaccine->age_group == 'child')
                                        <span class="badge bg-primary">Child</span>
                                    @elseif($vaccine->age_group == 'adolescent')
                                        <span class="badge bg-success">Adolescent</span>
                                    @elseif($vaccine->age_group == 'adult')
                                        <span class="badge bg-warning">Adult</span>
                                    @else
                                        <span class="badge bg-secondary">Senior</span>
                                    @endif
                                </td>
                                <td>{{ $vaccine->vaccine_type }}</td>
                                <td>{{ $vaccine->dose_number }}</td>
                                <td>{{ \Carbon\Carbon::parse($vaccine->date_administered)->format('M d, Y') }}</td>
                                <td>
                                    @if($vaccine->next_dose_date)
                                        {{ \Carbon\Carbon::parse($vaccine->next_dose_date)->format('M d, Y') }}
                                    @else
                                        <span class="text-muted">Completed</span>
                                    @endif
                                </td>
                                <td>{{ $vaccine->administered_by }}</td>
                                <td>
                                    <a href="{{ route('admin.vaccines.show', $vaccine->id) }}" 
                                       class="btn btn-info btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.vaccines.edit', $vaccine->id) }}" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.vaccines.destroy', $vaccine->id) }}" 
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this record?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No vaccine records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Client-side search filtering for Vaccine Records
    $(document).ready(function () {
        const $input = $('#searchInput');
        const $tbody = $('#vaccineTableBody');

        if ($input.length && $tbody.length) {
            $input.on('input', function () {
                const q = $(this).val().toLowerCase().trim();
                $tbody.find('tr').each(function () {
                    const text = $(this).text().toLowerCase();
                    $(this).toggle(text.indexOf(q) !== -1);
                });
            });
        }
    });
</script>
