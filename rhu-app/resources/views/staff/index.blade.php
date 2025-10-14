@extends('layout.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Clinic Dashboard</title>
        <style>
            /* KPI Section */
            .kpi-container {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }

            .kpi {
                flex: 1;
                padding: 15px;
                background-color: #fff;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                text-align: center;
            }

            .kpi h3 {
                font-size: 1.2rem;
                color: #555;
            }

            .kpi p {
                font-size: 1.8rem;
                font-weight: bold;
                color: #007bff;
            }

            @media (max-width: 768px) {
                .kpi-container {
                    grid-template-columns: 1fr;
                    gap: 15px;
                }
            }


            @media (max-width: 767px) {
                .kpi-container {
                    flex-direction: column;
                }

                .kpi-container .kpi {
                    margin-bottom: 15px;
                }
            }

            /* Module Styles */
            .module {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                margin-top: 20px;
            }

            .module h2 {
                color: #2a3d66;
                margin-bottom: 15px;
            }

            /* Greeting Card Styles */
            .greeting-card {
                background-color: #E6E6FA;
                border-radius: 15px;
                padding: 20px;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                width: 100%;
                margin: 20px auto;
                z-index: -1;
            }

            .greeting-card img {
                width: 150px;
                height: 150px;
                border-radius: 50%;
                margin-right: 20px;
            }

            .greeting-card p {
                color: #666;
                font-size: 14px;
                margin-top: 5px;
            }

            @media (max-width: 768px) {

                .kpi p {
                    font-size: 1.5rem;
                }

                .greeting-card {
                    width: 100%;
                }

                .greeting-card p,
                .wc h2,
                h4 {
                    flex-direction: column;
                    text-align: center;
                }

                .greeting-card img {
                    width: 120px;
                    height: 120px;
                    border-radius: 50%;
                    margin-right: 20px;
                }

                .greeting-card img {
                    margin: 0 auto 15px;
                }

                .greeting-card h4 {
                    font-size: 1.5rem;
                }

                .greeting-card p {
                    font-size: 0.9rem;
                }
            }
        </style>
    </head>

    <body>
        <div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-12">
                    {{-- <div class="card greeting-card p-4 d-flex align-items-center flex-md-row text-center text-md-start">
                        <!-- Image Avatar -->
                        <img src="{{ asset('img/doctor.webp') }}" alt="Doctor Avatar" ">

                              <!-- Greeting Text -->
                              <div class="wc">
                                <h2 class="display-6 mb-1">Good day!</h2>
                                <h4 class="text-danger mb-1">Doctor {{ Auth::user()->firstname }}</h4>
                                <p class="mb-0 text-muted">Caring for Every Life, Committed to Excellence.</p>
                              </div>
                            </div> --}}
                </div>
            </div>


            <!-- KPI Section -->

            <div class="kpi-container">
                <div class="kpi">
                    <h3>Total Patients</h3>
                    <p>{{ $totalPatients }}</p>
                </div>
                <div class="kpi">
                    <h3>Total Staff</h3>
                    <p>{{ $totalStaff }}</p>
                </div>
                <div class="kpi">
                    <h3>Total Appointments</h3>
                    <p>{{ $totalAppointments }}</p>
                </div>
            </div>

            <!-- Modules (Example: Appointments) -->
            <div class="module">
                <h2>Upcoming Appointments</h2>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="text-xs font-weight-bold font-weight-bold text-gray-800 text-uppercase mb-1">
                            <strong>Total:</strong>
                        </div>
                        <div class="h5 ms-1 mb-1.5  text-primary" id="appointmentCount">
                            {{ $appointments->count() }}</div>
                    </div>
                    {{-- Search bar --}}
                    <x-searchBar placeholder="Search appointments..." />
                </div>


                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover" id="appointmentTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-light">
                                    {{-- <th>ID</th> --}}
                                    <th>Patient Name</th>
                                    <th>Contact Info</th>
                                    <th>Date & Time</th>
                                    <th>Service</th>
                                    {{-- <th>Number of Checkup</th> --}}
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody id="appointmentTableBody">
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        {{-- <td>{{ $appointment->id }}</td> --}}
                                        <td>{{ $appointment->name }}</td>
                                        <td>{{ $appointment->contact_number }}</td>
                                        <td>{{ \Carbon\Carbon::parse($appointment->date_of_appointment)->format('F j, Y') }}
                                            /
                                            {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                                        </td>
                                        <td>{{ $appointment->service }}</td>
                                        {{-- <td>
                                            @if ($appointment->number_of_checkup == 'first checkup')
                                                <span class="badge bg-primary">First Checkup</span>
                                            @elseif($appointment->number_of_checkup == 'second checkup')
                                                <span class="badge bg-info">Second Checkup</span>
                                            @elseif($appointment->number_of_checkup == 'third checkup')
                                                <span class="badge bg-success">Third Checkup</span>
                                            @else
                                                <span class="badge bg-secondary">N/A</span>
                                            @endif
                                        </td> --}}
                                        <td>
                                            @if ($appointment->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($appointment->status == 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @elseif($appointment->status == 'cancelled')
                                                <span class="badge bg-danger">Cancelled</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $appointment->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.appointments.show', $appointment->id) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-eye text-white"></i></a>

                                            <a type="button" class=" open-modal text-decoration-none"
                                                data-bs-toggle="modal" data-bs-target="#smsModal"
                                                data-contact="{{ $appointment->contact_number }}">
                                                <img src="../img/uil--message.svg" alt="msg icon"
                                                    style="filter: invert(27%) sepia(99%) saturate(7487%) hue-rotate(202deg) brightness(98%) contrast(101%);">
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{-- Modal --}}
                        <div class="modal fade" id="smsModal" tabindex="-1" aria-labelledby="smsModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('send.sms') }}" class="modal-content" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="smsModalLabel">Send SMS</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="contact_number" id="contact_number">
                                        <div class="mb-3">
                                            <label for="message" class="form-label">Message</label>
                                            <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Send</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Modules -->
                    {{-- <div class="module">
                      <h2>Patient Records</h2>
                      <p>Display patient records here...</p>
                    </div> --}}
                </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const input = document.getElementById('searchInput');
                const tbody = document.getElementById('appointmentTableBody');

                if (!input || !tbody) return;

                input.addEventListener('input', function () {
                    const q = this.value.trim().toLowerCase();
                    const rows = Array.from(tbody.querySelectorAll('tr'));

                    rows.forEach((tr) => {
                        const text = tr.innerText.toLowerCase();
                        tr.style.display = text.includes(q) ? '' : 'none';
                    });
                });
            });
        </script>
    </body>

    </html>
@endsection
