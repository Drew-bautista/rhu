@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6">Animal Bite Cases</h1>
                        <a href="{{ route('staff.animal-bite.create') }}" class="btn btn-primary btn-sm">
                            Add Case
                        </a>
                    </div>
                </div>
                {{-- Search bar --}}
                <x-searchBar placeholder="Search animal bite cases..." />
            </div>

            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-hover" id="animalBiteTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="table-light">
                                <th>Patient Name</th>
                                <th>Date of Incident</th>
                                <th>Animal Type</th>
                                <th>Bite Site</th>
                                <th>Bite Category</th>
                                <th>ARV Dose</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="animalBiteTableBody">
                            @forelse($animalBiteCases as $case)
                                <tr>
                                    <td>{{ $case->appointment->name ?? 'N/A' }}</td>
                                    <td>{{ $case->date_of_incident ? \Carbon\Carbon::parse($case->date_of_incident)->format('Y/m/d') : '-' }}</td>
                                    <td>{{ $case->animal_type ?? '-' }}</td>
                                    <td>{{ $case->bite_site ?? '-' }}</td>
                                    <td>{{ $case->bite_category ?? '-' }}</td>
                                    <td>{{ $case->arv_dose ?? '-' }}</td>
                                    <td>{{ $case->remarks ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('staff.animal-bite.show', $case->id) }}" 
                                           class="btn btn-info btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('staff.animal-bite.edit', $case->id) }}" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No animal bite cases found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Client-side search functionality for animal bite cases
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            let query = $(this).val().toLowerCase().trim();
            let visibleRows = 0;

            $('#animalBiteTableBody tr').each(function() {
                let row = $(this);
                let text = row.text().toLowerCase();
                
                if (text.includes(query)) {
                    row.show();
                    visibleRows++;
                } else {
                    row.hide();
                }
            });
        });
    });
</script>
