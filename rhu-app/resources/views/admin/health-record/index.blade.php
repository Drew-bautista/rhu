@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="card-header">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6 fw-bolder text-uppercase">Health Assessment</h1>
                        <a href="{{ route('admin.health-record.create') }}" class="btn btn-primary btn-sm ">
                            Add Health Assessment
                        </a>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search patients..." />
                    </div>

                </div>

                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover" id="myTable" width="100%" cellspacing="0">
                            <!-- Health Assessments Table -->
                            <thead>
                                <tr class="table-light">
                                    <th>Patient Name</th>
                                    <th>Height</th>
                                    <th>Weight</th>
                                    <th>Blood Pressure</th>
                                    <th>Heart Rate</th>
                                    {{-- <th>Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($healthAssessments as $assessment)
                                    <tr onclick="window.location='{{ route('admin.health-record.show', $assessment->id) }}'
                                    ;"
                                        style="cursor: pointer;">
                                        <td>{{ $assessment->patient->lastname }}, {{ $assessment->patient->firstname }}
                                        </td>
                                        <td>{{ $assessment->height }}</td>
                                        <td>{{ $assessment->weight }}</td>
                                        <td>{{ $assessment->blood_pressure }}</td>
                                        <td>{{ $assessment->heart_rate }}</td>

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
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    //Search
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            let query = $(this).val();

            $.ajax({
                url: "/doctor/health-record/search",
                type: 'GET',
                data: {
                    search: query
                },
                success: function(data) {
                    let tableBody = $('#patientTableBody');
                    let patientCount = $('#patientCount');
                    tableBody.empty();

                    if (data.length > 0) {
                        $.each(data, function(index, patient) {
                            let row = `<tr onclick="window.location='patients/${patient.id}';" style="cursor: pointer;">
                                    <td>${patient.firstname} ${patient.lastname}</td>
                                    <td>${patient.role.charAt(0).toUpperCase() + patient.role.slice(1)}</td>
                                    <td>${patient.email}</td>
                                    <td>${patient.address}</td>
                                    <td>${patient.contact_no}</td>
                                </tr>`;
                            tableBody.append(row);
                        });
                        patientCount.text(data.length);
                    } else {
                        tableBody.append(
                            '<tr><td colspan="5" class="text-center text-muted">No patients found.</td></tr>'
                        );
                        patientCount.text('0');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                }
            });
        });
    });
</script>
