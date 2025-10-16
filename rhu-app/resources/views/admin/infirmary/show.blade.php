@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3 class="mb-0">Patient Health Assessment</h3>
                    <div>
                        <a href="{{ route('admin.infirmary.index') }}" class="text-dark" style="font-size: 1.25rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <!-- Patient Information Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-primary">Patient Information</h5>
                        <div>
                            <a href="{{ route('admin.infirmary.edit', $infirmary->id) }}" class="btn btn-primary btn-sm"><i
                                    class="fa fa-edit"></i></a>
                        </div>
                    </div>

                    <hr>
                    <p><strong>Name:</strong> {{ $infirmary->firstname }}
                        {{ $infirmary->lastname }}</p>
                    <p><strong>Date of Birth:</strong>
                        {{ \Carbon\Carbon::parse($infirmary->birthdate)->format('Y-m-d') }}</p>
                    <p><strong>Gender:</strong> {{ ucfirst($infirmary->sex) }}</p>
                    <p><strong>Address:</strong> {{ $infirmary->address }}</p>
                    <p><strong>Emergency Contact:</strong> {{ $infirmary->emergency_contact }}</p>
                </div>
                <!-- Health Assessment Section -->
                <div class="mb-4">
                    <h5 class="text-primary">Physical Examination</h5>
                    <hr>
                    <p><strong>Height:</strong> {{ $infirmary->height ?? 'N/A' }}</p>
                    <p><strong>Weight:</strong> {{ $infirmary->weight ?? 'N/A' }}</p>
                    <p><strong>Blood Pressure:</strong> {{ $infirmary->blood_pressure ?? 'N/A' }}</p>
                    <p><strong>Heart Rate:</strong> {{ $infirmary->heart_rate ?? 'N/A' }}</p>
                    <p><strong>Respiratory Rate:</strong> {{ $infirmary->respiratory_rate ?? 'N/A' }}</p>
                    <p><strong>Visual Acuity:</strong> {{ $infirmary->visual_acuity ?? 'N/A' }}</p>
                    <p><strong>Temperature:</strong> {{ $infirmary->temperature ?? 'N/A' }}</p>
                    {{-- <p><strong>Allergies:</strong> {{ $healthAssessment->allergies ?? 'N/A' }}</p>  --}}
                </div>


                <!-- Treatment Plan Section -->
                <div class="mb-4">
                    <h5 class="text-primary">Treatment</h5>
                    <hr>
                    <p><strong>Chief Complaint:</strong> {{ $infirmary->chief_complaint }}</p>
                    <p><strong>Laboratory Findings:</strong> {{ $infirmary->laboratory_findings }}</p>
                    <p><strong>Diagnosis:</strong> {{ $infirmary->assessment_diagnosis }}</p>
                    <p><strong>Medical History:</strong> {{ $infirmary->medical_history }}</p>
                    <p><strong>Treatment Medication:</strong> {{ $infirmary->medication_treatment }}</p>
                    <p>
                        <strong>Consultation Date & Time:</strong>
                        {{ \Carbon\Carbon::parse($infirmary->consultation_date_time)->format('F d, Y / h:i A') ?? 'N/A' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
