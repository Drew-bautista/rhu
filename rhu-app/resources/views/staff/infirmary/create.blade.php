@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="d-flex align-items-center justify-content-between">
                    <h1 class="display-6 fw-500">Add New Patient</h1>
                    <a href="{{ route('staff.infirmary.index') }}" class="btn btn-secondary bg-none btn-sm">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('staff.infirmary.store') }}" method="POST">
                    @csrf
                    <br>
                    <h4 class="text-primary">Patient Information</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sex">Sex</label>
                                <select name="sex" id="sex" class="form-control" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    {{-- <option value="other">Other</option> --}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" name="birthdate" id="birthdate" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_no">Contact No</label>
                                <input type="text" name="contact_no" id="contact_no" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emergency_contact">Emergency Contact</label>
                                <input type="text" name="emergency_contact" id="emergency_contact" class="form-control"
                                    pattern="[0-9]{11}" title="Emergency contact must be exactly 11 digits" 
                                    placeholder="09XXXXXXXXX" required>
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
                                    required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="weight">Weight (kg)</label>
                                <input type="number" step="0.01" name="weight" id="weight" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="blood_pressure">Blood Pressure</label>
                                <input type="text" name="blood_pressure" id="blood_pressure" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="heart_rate">Heart Rate (bpm)</label>
                                <input type="number" name="heart_rate" id="heart_rate" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="respiratory_rate">Respiratory Rate (breaths/min)</label>
                                <input type="number" name="respiratory_rate" id="respiratory_rate" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="visual_acuity">Visual Acuity</label>
                                <input type="text" name="visual_acuity" id="visual_acuity" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperature">Temperature (°C)</label>
                                <input type="number" step="0.01" name="temperature" id="temperature"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="consultation_date_time">Consultation Date & Time</label>
                                <input type="datetime-local" name="consultation_date_time" id="consultation_date_time"
                                    class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h4 class="text-primary">Treatment Details</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="chief_complaint">Chief Complaint</label>
                                <textarea name="chief_complaint" id="chief_complaint" class="form-control" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="laboratory_findings">Laboratory Findings</label>
                                <textarea name="laboratory_findings" id="laboratory_findings" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="assessment_diagnosis">Assessment/Diagnosis</label>
                                <textarea name="assessment_diagnosis" id="assessment_diagnosis" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="medical_history">Medical History</label>
                                <textarea name="medical_history" id="medical_history" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="medication_treatment">Medication/Treatment</label>
                                <textarea name="medication_treatment" id="medication_treatment" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="personal_social_history">Personal/Social History</label>
                                <textarea name="personal_social_history" id="personal_social_history" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pregnancy_history">Pregnancy History</label>
                                <textarea name="pregnancy_history" id="pregnancy_history" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary float-end mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
