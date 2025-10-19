@extends('layout.app')

@section('content')
    <div>
        <div class=" shadow">
            <div class="card-body px-4 px-md-5 pt-md-5 pt-3 position-relative">
                <div class="position-absolute top-0 end-0 mt-4 me-4">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary bg-none btn-sm">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-4 mb-m-0">
                    <h1 class="mb-m-4 fw-500">Appointment Details</h1>

                    <div>

                        <!-- Delete Button with Form -->
                        <!-- Delete Button -->
                        {{-- <form action="{{ route('staff.appointments.destroy', $appointment->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $appointment->id }}">
                                <i class="fas fa-trash"></i>
                            </button> --}}

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $appointment->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{ $appointment->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $appointment->id }}">
                                            Confirm
                                            Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this record?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4  pb-5">
                    <p class="card-text"><strong>Patient Name: </strong> {{ $appointment->name }}</p>
                    <p class="card-text"><strong>Contact Info:</strong> {{ $appointment->contact_number }}</p>
                    <p class="card-text"><strong>Appointment Date:</strong> {{ $appointment->date_of_appointment }}</p>
                    <p class="card-text"><strong>Appointment Time:</strong> {{ $appointment->time }}</p>
                    <p class="card-text"><strong>Date of Birth</strong> {{ $appointment->date_of_birth }}</p>
                    {{-- <p class="card-text"><strong>Insurance Info:</strong> {{ $appointment->insurance_info ?? 'N/A' }}</p> --}}
                    <p class="card-text"><strong> Age:</strong> {{ $appointment->age ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Emergency Contact:</strong> {{ $appointment->emergency_contact }}</p>
                    {{-- <p class="card-text"><strong>Medical History:</strong> {{ $appointment->medical_history ?? 'N/A' }}</p> --}}
                    <p class="card-text"><strong>Address:</strong> {{ $appointment->address ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Status:</strong>
                        @if ($appointment->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($appointment->status == 'completed')
                            <span class="badge bg-success">Completed</span>
                        @elseif($appointment->status == 'cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                        @else
                            <span class="badge bg-secondary">Unknown</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        {{-- @include('staff.appointment.ConfirmationDeleteModal') --}}
    @endsection
