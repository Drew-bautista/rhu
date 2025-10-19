@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6">Newborn Screening</h1>
                        <a href="{{ route('staff.newborn_screenings.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Newborn Screening
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <div class="d-flex align-items-center">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <strong>Total:</strong>
                            </div>
                            <div class="h5 ms-1 mb-1.5 font-weight-bold text-gray-800" id="screeningCount">
                                {{ $screenings->count() }}
                            </div>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search newborn screening..." />
                    </div>
                </div>

                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover" id="screeningTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Sex</th>
                                    <th>DOB</th>
                                    <th>Mother</th>
                                    <th>Screening Date</th>
                                    <th>Result</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($screenings as $screening)
                                    <tr>
                                        <td>{{ $screening->first_name }} {{ $screening->last_name }}</td>
                                        <td>{{ $screening->sex }}</td>
                                        <td>{{ $screening->date_of_birth->format('Y-m-d') }}</td>
                                        <td>{{ $screening->mother_name }}</td>
                                        <td>{{ $screening->screening_date->format('Y-m-d') }}</td>
                                        <td>{{ $screening->result_status }}</td>
                                        <td>
                                            <a href="{{ route('staff.newborn_screenings.show', $screening->id) }}"
                                                class="btn btn-info btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('staff.newborn_screenings.edit', $screening->id) }}"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No newborn screening records found.</td>
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
    // Client-side search functionality for newborn screening
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            let query = $(this).val().toLowerCase().trim();
            let visibleRows = 0;

            $('#screeningTable tbody tr').each(function() {
                let row = $(this);
                let text = row.text().toLowerCase();
                
                if (text.includes(query)) {
                    row.show();
                    visibleRows++;
                } else {
                    row.hide();
                }
            });

            // Update count if there's a counter element
            if ($('#screeningCount').length) {
                $('#screeningCount').text(visibleRows);
            }
        });
    });
</script>
