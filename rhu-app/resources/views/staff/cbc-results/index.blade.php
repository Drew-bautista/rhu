@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6 ">CBC Results</h1>

                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <strong>Total:</strong>
                            </div>
                            <div class="h5 ms-1 mb-1.5 font-weight-bold text-gray-800" id="appointmentCount">
                            </div>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search appointments..." />
                    </div>
                </div>

                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover" id="appointmentTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-light">
                                    <th>Name</th>
                                    {{-- <th>Test Date</th> --}}
                                    <th>Hemoglobin</th>
                                    <th>Hematocrit</th>
                                    <th>RBC</th>
                                    <th>WBC</th>
                                    <th>Platelet</th>


                                </tr>
                            </thead>
                            <tbody id="appointmentTableBody">
                                @forelse($cbcResults as $cbcResult)
                                    <tr style="cursor: pointer;"
                                        onclick="window.location='{{ route('staff.cbc-results.show', $cbcResult->id) }}'">
                                        <td>
                                            {{ $cbcResult->appointments->name }}
                                        </td>
                                        {{-- <td>{{ \Carbon\Carbon::parse($cbcResult->appointments->date_of_appointment)->format('Y/m/d') }}
                                        </td> --}}
                                        <td>{{ $cbcResult->hemoglobin }}</td>
                                        <td>
                                            {{ $cbcResult->hematocrit }}
                                        </td>
                                        <td>{{ $cbcResult->rbc_count }}</td>
                                        <td>
                                            {{ $cbcResult->wbc_count }}
                                        </td>
                                        <td>{{ $cbcResult->platelet_count }}</td>
                                        {{-- <td>
                                            {{ \Carbon\Carbon::parse($cbcResult->appointment_date)->format('Y/m/d') }} /
                                            {{ \Carbon\Carbon::parse($cbcResult->time)->format('h:i A') }}
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No appointments found.</td>
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
    // Search functionality for appointments
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            let query = $(this).val();

            $.ajax({
                url: "/appointments/search",
                type: 'GET',
                data: {
                    search: query
                },
                success: function(data) {
                    let tableBody = $('#appointmentTableBody');
                    let appointmentCount = $('#appointmentCount');
                    tableBody.empty();

                    if (data.length > 0) {
                        $.each(data, function(index, appointment) {
                            let row = `<tr>
                                    <td>${appointment.patient.firstname} ${appointment.patient.lastname}</td>
                                    <td>${appointment.appointment_date}</td>
                                    <td>${appointment.appointment_time}</td>
                                    <td>${appointment.status.charAt(0).toUpperCase() + appointment.status.slice(1)}</td>
                                    <td>
                                        <a href="/appointments/${appointment.id}" class="btn btn-primary btn-sm">View</a>
                                        <a href="/appointments/${appointment.id}/edit" class="btn btn-secondary btn-sm">Edit</a>
                                    </td>
                                </tr>`;
                            tableBody.append(row);
                        });
                        appointmentCount.text(data.length);
                    } else {
                        tableBody.append(
                            '<tr><td colspan="5" class="text-center text-muted">No appointments found.</td></tr>'
                        );
                        appointmentCount.text('0');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                }
            });
        });
    });
</script>
