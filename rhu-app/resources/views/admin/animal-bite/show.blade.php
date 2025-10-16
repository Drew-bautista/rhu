@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3 class="mb-0">Animal Bite Case</h3>
                    <div>
                        <a href="{{ route('admin.animal-bite.index') }}" class="text-dark" style="font-size: 1.25rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <!-- Patient / Appointment Information Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-primary">Patient / Appointment Details</h5>
                        <div>
                            <a href="{{ route('admin.animal-bite.edit', $animalBiteCase->id) }}" class="btn btn-warning btn-sm">Update Data</a>
                        </div>
                    </div>

                    <hr>
                    <p><strong>Name:</strong> {{ $animalBiteCase->appointment->name ?? 'N/A' }}</p>
                    <p><strong>Age:</strong> {{ $animalBiteCase->appointment->age ?? 'N/A' }}</p>
                    <p><strong>Contact:</strong> {{ $animalBiteCase->appointment->contact_number ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $animalBiteCase->appointment->address ?? 'N/A' }}</p>
                    <p><strong>Service:</strong> {{ $animalBiteCase->appointment->service ?? 'N/A' }}</p>
                    <p>
                        <strong>Appointment Date & Time:</strong>
                        @if ($animalBiteCase->appointment)
                            {{ \Carbon\Carbon::parse($animalBiteCase->appointment->date_of_appointment)->format('F j, Y') }}
                            /
                            {{ \Carbon\Carbon::parse($animalBiteCase->appointment->time)->format('h:i A') }}
                        @else
                            N/A
                        @endif
                    </p>
                </div>

                <!-- Animal Bite Case Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-primary">Animal Bite Case Details</h5>
                        <a href="{{ route('admin.animal-bite.edit', $animalBiteCase->id) }}"
                            class="btn btn-warning btn-sm">Update Data</a>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Date of Incident:</strong> {{ $animalBiteCase->date_of_incident ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Animal Type:</strong> {{ $animalBiteCase->animal_type ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Animal Ownership:</strong> {{ $animalBiteCase->animal_ownership ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Vaccination Status:</strong>
                                {{ $animalBiteCase->animal_vaccination_status ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Animal Behavior:</strong> {{ $animalBiteCase->animal_behavior ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-6">
                            <p><strong>Bite Site:</strong> {{ $animalBiteCase->bite_site ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Bite Category:</strong> {{ $animalBiteCase->bite_category ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-12">
                            <p><strong>Wound Description:</strong> {{ $animalBiteCase->wound_description ?? 'N/A' }}</p>
                        </div>

                        <hr class="mt-3">

                        <div class="col-md-6">
                            <p><strong>First Consultation Date:</strong>
                                {{ $animalBiteCase->first_consultation_date ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>ARV Dose:</strong> {{ $animalBiteCase->arv_dose ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>ARV Date:</strong> {{ $animalBiteCase->arv_date ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>RIG Administered:</strong> {{ $animalBiteCase->rig_administered ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-12">
                            <p><strong>Remarks:</strong> {{ $animalBiteCase->remarks ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
