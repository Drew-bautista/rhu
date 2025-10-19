@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6">Prenatal Records</h1>
                        <a href="{{ route('staff.prenatal-record.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Prenatal Record
                        </a>
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
                                    {{-- <th>ID</th> --}}
                                    <th>Name</th>
                                    <th>Height</th>
                                    <th>Weight</th>
                                    <th>Blood Pressure</th>
                                    <th>Age of Gestation</th>
                                    <th>Nutrition</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="appointmentTableBody">
                                @forelse($prenatalRecords as $prenatal)
                                    <tr>
                                        <td>{{ $prenatal->appointments->name }}</td>
                                        <td>{{ $prenatal->height }}</td>
                                        <td>{{ $prenatal->weight }}</td>
                                        <td>{{ $prenatal->blood_pressure }}
                                        </td>
                                        <td>{{ $prenatal->age_of_gestation }}</td>
                                        <td>
                                            @if ($prenatal->nutritional_status == 'underweight')
                                                <span class="badge bg-warning text-dark">Underweight</span>
                                            @elseif($prenatal->nutritional_status == 'normal')
                                                <span class="badge bg-success">Normal</span>
                                            @elseif($prenatal->nutritional_status == 'overweight')
                                                <span class="badge bg-info text-dark">Overweight</span>
                                            @else
                                                <span class="text-muted">Not Set</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('staff.prenatal-record.show', $prenatal->id) }}" 
                                               class="btn btn-info btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('staff.prenatal-record.edit', $prenatal->id) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No prenatal records found.</td>
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
