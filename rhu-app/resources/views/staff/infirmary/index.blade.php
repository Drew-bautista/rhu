@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="card-header">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6 ">Health Assessment</h1>
                        <a href="{{ route('staff.infirmary.create') }}" class="btn btn-primary btn-sm">
                            Add Data
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <strong>Total:</strong>
                            </div>
                            <div class="h5 ms-1 mb-1.5 font-weight-bold text-gray-800" id="patientCount">
                            </div>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search patients..." />
                    </div>

                </div>
            </div>

            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-hover" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="table-light">
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Blood Pressure</th>
                                <th>Diagnosis</th>
                                <th>Chief Complaint</th>
                                {{-- <th>Action</th --}}
                            </tr>
                        </thead>
                        <tbody id="patientTableBody">
                            @foreach ($infirmary as $infirmaries)
                                <tr style="cursor: pointer;"
                                    onclick="window.location='{{ route('staff.infirmary.show', $infirmaries->id) }}';">

                                    <td>
                                        <p>{{ $infirmaries->firstname }} {{ $infirmaries->lastname }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $infirmaries->sex }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $infirmaries->address }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $infirmaries->contact_no }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $infirmaries->blood_pressure }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $infirmaries->assessment_diagnosis }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $infirmaries->chief_complaint }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Client-side search functionality for health assessment
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            let query = $(this).val().toLowerCase().trim();
            let visibleRows = 0;

            $('#myTable tbody tr').each(function() {
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
            if ($('#patientCount').length) {
                $('#patientCount').text(visibleRows);
            }
        });
    });
</script>
