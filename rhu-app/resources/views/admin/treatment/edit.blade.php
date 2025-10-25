@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Treatment Record</h2>
                        <a href="{{ route('admin.treatment.index') }}" class="btn btn-secondary float-end">Back to List</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.treatment.update', $treatment->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <!-- Patient Selection -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="patient_id"><strong>Patient</strong> <span class="text-danger">*</span></label>
                                    <select name="patient_id" id="patient_id" class="form-control" required>
                                        <option value="">Select Patient</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->id }}" {{ $treatment->patient_id == $patient->id ? 'selected' : '' }}>
                                                {{ $patient->firstname }} {{ $patient->lastname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="consultation_date_time"><strong>Consultation Date & Time</strong> <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="consultation_date_time" id="consultation_date_time" 
                                           class="form-control" value="{{ $treatment->consultation_date_time }}" required>
                                </div>
                            </div>

                            <!-- Chief Complaint -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="chief_complaint"><strong>Chief Complaint</strong></label>
                                    <textarea name="chief_complaint" id="chief_complaint" class="form-control" rows="3">{{ $treatment->chief_complaint }}</textarea>
                                </div>
                            </div>

                            <!-- Laboratory Findings -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="laboratory_findings"><strong>Laboratory Findings</strong></label>
                                    <textarea name="laboratory_findings" id="laboratory_findings" class="form-control" rows="3">{{ $treatment->laboratory_findings }}</textarea>
                                </div>
                            </div>

                            <!-- Assessment & Diagnosis -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="assessment_diagnosis"><strong>Assessment & Diagnosis</strong></label>
                                    <textarea name="assessment_diagnosis" id="assessment_diagnosis" class="form-control" rows="3">{{ $treatment->assessment_diagnosis }}</textarea>
                                </div>
                            </div>

                            <!-- Medical History -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="medical_history"><strong>Medical History</strong></label>
                                    <textarea name="medical_history" id="medical_history" class="form-control" rows="3">{{ $treatment->medical_history }}</textarea>
                                </div>
                            </div>

                            <!-- Medication and Treatment -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="medication_treatment"><strong>Medication and Treatment</strong></label>
                                    <textarea name="medication_treatment" id="medication_treatment" class="form-control" rows="3">{{ $treatment->medication_treatment }}</textarea>
                                </div>
                            </div>

                            <!-- Personal and Social History -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="personal_social_history"><strong>Personal and Social History</strong></label>
                                    <textarea name="personal_social_history" id="personal_social_history" class="form-control" rows="3">{{ $treatment->personal_social_history }}</textarea>
                                </div>
                            </div>

                            <!-- Pregnancy History -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="pregnancy_history"><strong>Pregnancy History</strong></label>
                                    <textarea name="pregnancy_history" id="pregnancy_history" class="form-control" rows="3">{{ $treatment->pregnancy_history }}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Update Treatment</button>
                                    <a href="{{ route('admin.treatment.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
