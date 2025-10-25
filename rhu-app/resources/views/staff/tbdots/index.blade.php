@extends('layout.app')

@section('content')
<div class="shadow mb-4 w-full p-md-5">
    <div class="container">
        <div class="row">
            <div class="col mr-0">
                <div class="d-flex align-items-center justify-content-between">
                    <h1 class="display-6">TBDOTS Cases</h1>
                    <a href="{{ route('staff.tbdots.create') }}" class="btn btn-primary btn-sm">
                        Add Case
                    </a>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <div class="d-flex align-items-center">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <strong>Total:</strong>
                        </div>
                        <div class="h5 ms-1 mb-1.5 font-weight-bold text-gray-800" id="tbdotsCount">
                            {{ $tbdots->count() }}
                        </div>
                    </div>
                    <x-searchBar placeholder="Search TBDOTS cases..." />
                </div>
            </div>

            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-hover" id="tbdotsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="table-light">
                                <th>Patient Name</th>
                                <th>Date of Diagnosis</th>
                                <th>Type of TB</th>
                                <th>Treatment Status</th>
                                <th>Treatment Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tbdots as $case)
                                <tr>
                                    <td>{{ $case->patient_name ?: optional($case->appointment)->name ?: 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($case->date_of_diagnosis)->format('Y/m/d') }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $case->tb_type)) }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $case->treatment_status)) }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $case->treatment_category)) }}</td>
                                    <td>
                                        <a href="{{ route('staff.tbdots.show', $case->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('staff.tbdots.edit', $case->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No TBDOTS cases found.</td>
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
    // Client-side search functionality for TBDOTS cases
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            let query = $(this).val().toLowerCase().trim();
            let visibleRows = 0;

            $('#tbdotsTable tbody tr').each(function() {
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
            if ($('#tbdotsCount').length) {
                $('#tbdotsCount').text(visibleRows);
            }
        });
    });
</script>
