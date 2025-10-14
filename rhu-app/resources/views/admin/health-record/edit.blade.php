@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-5" id="createHealthModal">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h2>Edit Health Assessment</h2>
                            <form action="{{ route('admin.health-record.update', $healthAssessment->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Personal Details -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="request_type" class="form-label fw-bolder">Patient Name</label>
                                        <select class="selectpicker form-control" id="patient_id" data-live-search="true"
                                            name="patient_id" required>
                                            <option></option>
                                            @foreach ($patients as $patient)
                                                <option value="{{ $patient->id }}"
                                                    {{ $patient->id == $healthAssessment->patient_id ? 'selected' : '' }}>
                                                    {{ $patient->lastname }}, {{ $patient->firstname }}
                                                    {{ $patient->middlename }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sex"><strong>Sex</strong></label>
                                        <input type="text" name="sex" id="sex" class="form-control"
                                            value="{{ $healthAssessment->patient->sex }}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="emergency_contact"><strong>Emergency Contact</strong></label>
                                        <input type="text" name="emergency_contact" id="emergency_contact"
                                            class="form-control" value="{{ $healthAssessment->patient->contact_no }}"
                                            disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="address"><strong>Address</strong></label>
                                        <input type="text" name="address" id="address" class="form-control"
                                            value="{{ $healthAssessment->patient->address }}" disabled>
                                    </div>
                                </div>

                                <hr>

                                <!-- Health Information -->
                                <h5 class="mb-3">Health Information</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="height"><strong>Height</strong></label>
                                        <input type="text" name="height" id="height" class="form-control"
                                            value="{{ $healthAssessment->height }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="weight"><strong>Weight</strong></label>
                                        <input type="text" name="weight" id="weight" class="form-control"
                                            value="{{ $healthAssessment->weight }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="blood_pressure"><strong>Blood Pressure</strong></label>
                                        <input type="text" name="blood_pressure" id="blood_pressure" class="form-control"
                                            value="{{ $healthAssessment->blood_pressure }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="heart_rate"><strong>Heart Rate</strong></label>
                                        <input type="text" name="heart_rate" id="heart_rate" class="form-control"
                                            value="{{ $healthAssessment->heart_rate }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="medical_conditions"><strong>Medical Conditions</strong></label>
                                        <input type="text" name="medical_conditions" id="medical_conditions"
                                            class="form-control" value="{{ $healthAssessment->medical_conditions }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="medical_history"><strong>Medical History</strong></label>
                                        <input type="text" name="medical_history" id="medical_history"
                                            class="form-control" value="{{ $healthAssessment->medical_history }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="symptoms"><strong>Symptoms</strong></label>
                                        <input type="text" name="symptoms" id="symptoms" class="form-control"
                                            value="{{ $healthAssessment->symptoms }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="allergies"><strong>Allergies</strong></label>
                                        <input type="text" name="allergies" id="allergies" class="form-control"
                                            value="{{ $healthAssessment->allergies }}">
                                    </div>
                                </div>
                                <div class="d-flex mt-3 float-end">
                                    <button type="submit" class="btn btn-primary mt-3">Update Assessment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
