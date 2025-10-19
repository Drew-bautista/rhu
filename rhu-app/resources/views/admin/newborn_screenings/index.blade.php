@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6">Newborn Screening</h1>
                        <a href="{{ route('admin.newborn_screenings.create') }}" class="btn btn-primary btn-sm">
                            Add Data
                        </a>
                    </div>
                            </div>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search urinalysis..." />
                    </div>
                </div>

                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover" id="urinalysisTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Sex</th>
                                    <th>DOB</th>
                                    <th>Mother</th>
                                    <th>Screening Date</th>
                                    <th>Result</th>
                                    {{-- <th>Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody id="newbornTableBody">
                                @forelse ($screenings as $screening)
                                    <tr style="cursor: pointer;"
                                        onclick="window.location='{{ route('admin.newborn_screenings.show', $screening->id) }}'">
                                        <td>{{ $screening->first_name }} {{ $screening->last_name }}</td>
                                        <td>{{ $screening->sex }}</td>
                                        <td>{{ $screening->date_of_birth->format('Y-m-d') }}</td>
                                        <td>{{ $screening->mother_name }}</td>
                                        <td>{{ $screening->screening_date->format('Y-m-d') }}</td>
                                        <td>{{ $screening->result_status }}</td>
                                        {{-- <td>
                                            <a href="{{ route('admin.newborn_screenings.show', $screening->id) }}"
                                                class="btn btn-outline-info btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('admin.newborn_screenings.edit', $screening->id) }}"
                                                class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.newborn_screenings.destroy', $screening->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm" title="Delete"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No newborn screening records found.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Client-side filter for Newborn Screening
    $(document).ready(function () {
        const $input = $('#searchInput');
        const $tbody = $('#newbornTableBody');

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
