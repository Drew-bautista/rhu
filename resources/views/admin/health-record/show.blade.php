@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Patient Health Assessment</h3>

                <!-- Patient Information Section -->
                <!-- Patient Information Section -->
                <div class="mb-4">
                    <h5 class="text-primary">Patient Information</h5>
                    <hr>
                    <p><strong>Name:</strong> {{ $healthAssessment->patient->firstname }}
                        {{ $healthAssessment->patient->lastname }}</p>
                    <p><strong>Date of Birth:</strong>
                        {{ \Carbon\Carbon::parse($healthAssessment->patient->birthdate)->format('Y-m-d') }}</p>
                    <p><strong>Gender:</strong> {{ ucfirst($healthAssessment->patient->sex) }}</p>
                    <p><strong>Address:</strong> {{ $healthAssessment->patient->address }}</p>
                    <p><strong>Emergency Contact:</strong> {{ $healthAssessment->patient->emergency_contact }}</p>
                </div>
                <!-- Health Assessment Section -->
                <div class="mb-4">
                    <h5 class="text-primary">Pertinent Physical Examination</h5>
                    <hr>
                    <p><strong>Height:</strong> {{ $healthAssessment->height ?? 'N/A' }}</p>
                    <p><strong>Weight:</strong> {{ $healthAssessment->weight ?? 'N/A' }}</p>
                    <p><strong>Blood Pressure:</strong> {{ $healthAssessment->blood_pressure ?? 'N/A' }}</p>
                    <p><strong>Heart Rate:</strong> {{ $healthAssessment->heart_rate ?? 'N/A' }}</p>
                    <p><strong>Respiratory Rate:</strong> {{ $healthAssessment->respiratory_rate ?? 'N/A' }}</p>
                    <p><strong>Visual Acuity:</strong> {{ $healthAssessment->visual_acuity ?? 'N/A' }}</p>
                    <p><strong>Temperature:</strong> {{ $healthAssessment->temperature ?? 'N/A' }}</p>
                    {{-- <p><strong>Allergies:</strong> {{ $healthAssessment->allergies ?? 'N/A' }}</p>  --}}
                </div>


                <!-- Treatment Plan Section -->
                {{-- <div class="mb-4">
                    <h5 class="text-primary">Treatment Record</h5>
                    <hr>
                    <p><strong>Treatment Description:</strong> Symptomatic treatment for viral infection</p>
                    <p><strong>Medications Prescribed:</strong> Acetaminophen (500 mg) - 1 tablet every 6 hours</p>
                    <p><strong>Treatment Start Date:</strong> 2024-10-28</p>
                    <p><strong>Treatment End Date:</strong> 2024-11-02</p>
                    <p><strong>Follow-up Required:</strong> Yes, in 1 week</p>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
