@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="d-flex align-items-center justify-content-between">
                    <h1 class="display-6 fw-500">Edit Data</h1>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary bg-none btn-sm">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('staff.infirmary.update', $infirmary->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <br>
                    <h4 class="text-primary">Patient Information</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control"
                                    value="{{ old('firstname', $infirmary->firstname) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control"
                                    value="{{ old('lastname', $infirmary->lastname) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ old('address', $infirmary->address) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sex">Sex</label>
                                <select name="sex" id="sex" class="form-control" required>
                                    <option value="male" {{ old('sex', $infirmary->sex) == 'male' ? 'selected' : '' }}>
                                        Male</option>
                                    <option value="female" {{ old('sex', $infirmary->sex) == 'female' ? 'selected' : '' }}>
                                        Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" name="birthdate" id="birthdate" class="form-control"
                                    value="{{ old('birthdate', $infirmary->birthdate) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_no">Contact No</label>
                                <input type="text" name="contact_no" id="contact_no" class="form-control"
                                    value="{{ old('contact_no', $infirmary->contact_no) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emergency_contact">Emergency Contact</label>
                                <input type="text" name="emergency_contact" id="emergency_contact" class="form-control"
                                    value="{{ old('emergency_contact', $infirmary->emergency_contact) }}" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h4 class="text-primary">Physical Examination</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="height">Height (cm)</label>
                                <input type="number" step="0.01" name="height" id="height" class="form-control"
                                    value="{{ old('height', $infirmary->height) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="weight">Weight (kg)</label>
                                <input type="number" step="0.01" name="weight" id="weight" class="form-control"
                                    value="{{ old('weight', $infirmary->weight) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="blood_pressure">Blood Pressure</label>
                                <input type="text" name="blood_pressure" id="blood_pressure" class="form-control"
                                    value="{{ old('blood_pressure', $infirmary->blood_pressure) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="heart_rate">Heart Rate (bpm)</label>
                                <input type="number" name="heart_rate" id="heart_rate" class="form-control"
                                    value="{{ old('heart_rate', $infirmary->heart_rate) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="respiratory_rate">Respiratory Rate (breaths/min)</label>
                                <input type="number" name="respiratory_rate" id="respiratory_rate" class="form-control"
                                    value="{{ old('respiratory_rate', $infirmary->respiratory_rate) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="visual_acuity">Visual Acuity</label>
                                <input type="text" name="visual_acuity" id="visual_acuity" class="form-control"
                                    value="{{ old('visual_acuity', $infirmary->visual_acuity) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="temperature">Temperature (°C)</label>
                                <input type="number" step="0.01" name="temperature" id="temperature"
                                    class="form-control" value="{{ old('temperature', $infirmary->temperature) }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="consultation_date_time">Consultation Date & Time</label>
                                <input type="datetime-local" name="consultation_date_time" id="consultation_date_time"
                                    class="form-control"
                                    value="{{ old('consultation_date_time', \Carbon\Carbon::parse($infirmary->consultation_date_time)->format('Y-m-d\TH:i')) }}"
                                    required>
                            </div>
                        </div>
                    </div>

                    <br>
                    <h4 class="text-primary">Treatment</h4>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="chief_complaint">Chief Complaint</label>
                                <textarea name="chief_complaint" id="chief_complaint" class="form-control" rows="2" required>{{ old('chief_complaint', $infirmary->chief_complaint) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="laboratory_findings">Laboratory Findings</label>
                                <textarea name="laboratory_findings" id="laboratory_findings" class="form-control" rows="2">{{ old('laboratory_findings', $infirmary->laboratory_findings) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="assessment_diagnosis">Assessment/Diagnosis</label>
                                <textarea name="assessment_diagnosis" id="assessment_diagnosis" class="form-control" rows="2">{{ old('assessment_diagnosis', $infirmary->assessment_diagnosis) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="medical_history">Medical History</label>
                                <textarea name="medical_history" id="medical_history" class="form-control" rows="2">{{ old('medical_history', $infirmary->medical_history) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="personal_social_history">Personal/Social History</label>
                                <textarea name="personal_social_history" id="personal_social_history" class="form-control" rows="2">{{ old('personal_social_history', $infirmary->personal_social_history) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pregnancy_history">Pregnancy History</label>
                                <textarea name="pregnancy_history" id="pregnancy_history" class="form-control" rows="2">{{ old('pregnancy_history', $infirmary->pregnancy_history) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning float-end mt-4">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
