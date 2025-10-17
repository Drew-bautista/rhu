@extends('layout.app')

@section('content')
    <div>
        <div class=" shadow">
            <div class="card-body px-4 px-md-5 pt-md-5 pt-3 position-relative">
                <div class="position-absolute top-0 end-0 mt-4 me-4">
                    <a href="{{ route('admin.appointments.index') }}" class="text-dark" style="font-size: 1.25rem;">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-4 mb-m-0">
                    <h1 class="mb-m-4 fw-500">Appointment Details</h1>

                    <div>
                        <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="btn btn-primary"><i
                                class="fas fa-edit me-2"></i>Edit</a>
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
        {{-- @include('admin.appointment.ConfirmationDeleteModal') --}}
    @endsection
