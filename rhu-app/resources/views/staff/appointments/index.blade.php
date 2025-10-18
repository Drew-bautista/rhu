@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6">Monthly Appointments</h1>
                        <a href="{{ route('staff.appointments.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Appointment
                        </a>
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
                                        <td>{{ \Carbon\Carbon::parse($appointment->date_of_appointment)->format('F j, Y') }} /
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
                                            <a href="{{ route('staff.appointments.show', $appointment->id) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-eye text-white"></i></a>

                                            {{-- <a type="button" class=" open-modal text-decoration-none"
                                                data-bs-toggle="modal" data-bs-target="#smsModal"
                                                data-contact="{{ $appointment->contact_number }}">
                                                <img src="../img/uil--message.svg" alt="msg icon"
                                                    style="filter: invert(27%) sepia(99%) saturate(7487%) hue-rotate(202deg) brightness(98%) contrast(101%);">
                                            </a> --}}
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
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Client-side search functionality for appointments
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            let query = $(this).val().toLowerCase().trim();
            let visibleRows = 0;

            $('#appointmentTableBody tr').each(function() {
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
            if ($('#appointmentCount').length) {
                $('#appointmentCount').text(visibleRows);
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const modalTriggerButtons = document.querySelectorAll(".open-modal");

        modalTriggerButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                const contact = button.getAttribute("data-contact");
                document.getElementById("contact_number").value = contact;
            });
        });
    });
</script>
