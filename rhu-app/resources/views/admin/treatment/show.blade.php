@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Treatment Details</h2>
                        <a href="{{ route('admin.treatment.index') }}" class="btn btn-secondary float-end">Back to List</a>
                    </div>
                    <div class="card-body">
                        <!-- Patient Details -->
                        <h4 class="mb-3">Patient Information</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label><strong>Patient Name:</strong></label>
                                <p>{{ $treatment->patient->firstname }} {{ $treatment->patient->lastname }}</p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Sex:</strong></label>
                                <p>{{ $treatment->patient->sex }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label><strong>Contact Number:</strong></label>
                                <p>{{ $treatment->patient->contact_no }}</p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Address:</strong></label>
                                <p>{{ $treatment->patient->address }}</p>
                            </div>
                        </div>

                        <hr>

                        <!-- Health Assessment Details -->
                        {{-- <h4 class="mb-3">Health Assessment Information</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label><strong>Assessment ID:</strong></label>
                                <p>{{ $treatment->healthAssessment->id }}</p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Assessment Date:</strong></label>
                                <p>{{ $treatment->healthAssessment->created_at->format('Y-m-d') }}</p>
                            </div>
                        </div>

                        {{-- <hr> --}}

                        <!-- Treatment Details -->
                        <h4 class="mb-3">Treatment Information</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label><strong>Consultation Date & Time:</strong></label>
                                <p>{{ $treatment->consultation_date_time }}</p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Chief Complaint:</strong></label>
                                <p>{{ $treatment->chief_complaint }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label><strong>Laboratory Findings:</strong></label>
                                <p>{{ $treatment->laboratory_findings ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Assessment & Diagnosis:</strong></label>
                                <p>{{ $treatment->assessment_diagnosis ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label><strong>Medical History:</strong></label>
                                <p>{{ $treatment->medical_history ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Medication & Treatment:</strong></label>
                                <p>{{ $treatment->medication_treatment ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label><strong>Personal & Social History:</strong></label>
                                <p>{{ $treatment->personal_social_history ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Pregnancy History:</strong></label>
                                <p>{{ $treatment->pregnancy_history ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
