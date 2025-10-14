@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-5" id="createTreatmentModal">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h2>Create New Treatment</h2>
                            <hr>
                            <form action="{{ route('admin.treatment.store') }}" method="POST">
                                @csrf

                                <!-- Personal Details -->
                                <h5 class="mb-3">Patient Information</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="patient_id" class="form-label fw-bolder">Patient Name</label>
                                        <select class="selectpicker form-control" id="patient_id" data-live-search="true"
                                            name="patient_id" required>
                                            <option></option>
                                            @foreach ($patients as $patient)
                                                <option value="{{ $patient->id }}" data-sex="{{ $patient->sex }}"
                                                    data-contact-no="{{ $patient->contact_no }}"
                                                    data-address="{{ $patient->address }}">
                                                    {{ $patient->lastname }}, {{ $patient->firstname }}
                                                    {{ $patient->middlename }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sex"><strong>Sex</strong></label>
                                        <input type="text" name="sex" id="sex" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="emergency_contact"><strong>Emergency Contact</strong></label>
                                        <input type="text" name="emergency_contact" id="emergency_contact"
                                            class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="address"><strong>Address</strong></label>
                                        <input type="text" name="address" id="address" class="form-control" disabled>
                                    </div>
                                </div>

                                <hr>

                                <!-- Treatment Information -->
                                <h5 class="mb-3">Treatment Information</h5>

                                <!-- Consultation Date and Time -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="consultation_date_time"><strong>Consultation Date and
                                                Time</strong></label>
                                        <input type="datetime-local" name="consultation_date_time"
                                            id="consultation_date_time" class="form-control" required>
                                    </div>
                                </div>

                                <!-- Chief Complaint -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="chief_complaint"><strong>Chief Complaint</strong></label>
                                        <textarea name="chief_complaint" id="chief_complaint" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>

                                <!-- Laboratory Findings -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="laboratory_findings"><strong>Laboratory Findings</strong></label>
                                        <textarea name="laboratory_findings" id="laboratory_findings" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>

                                <!-- Assessment and Diagnosis -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="assessment_diagnosis"><strong>Assessment and Diagnosis</strong></label>
                                        <textarea name="assessment_diagnosis" id="assessment_diagnosis" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>

                                <!-- Medical History -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="medical_history"><strong>Medical History</strong></label>
                                        <textarea name="medical_history" id="medical_history" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>

                                <!-- Medication and Treatment -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="medication_treatment"><strong>Medication and Treatment</strong></label>
                                        <textarea name="medication_treatment" id="medication_treatment" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>

                                <!-- Personal and Social History -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="personal_social_history"><strong>Personal and Social
                                                History</strong></label>
                                        <textarea name="personal_social_history" id="personal_social_history" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>

                                <!-- Pregnancy History -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="pregnancy_history"><strong>Pregnancy History</strong></label>
                                        <textarea name="pregnancy_history" id="pregnancy_history" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex mt-3 float-end">
                                    <button type="submit" class="btn btn-primary mt-3">Create Treatment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Listen for changes in the patient dropdown
        $('#patient_id').change(function() {
            // Get the selected option
            const selectedOption = $(this).find(':selected');

            // Extract data attributes
            const sex = selectedOption.data('sex');
            const contactNo = selectedOption.data('contact-no');
            const address = selectedOption.data('address');

            // Populate the fields
            $('#sex').val(sex);
            $('#emergency_contact').val(contactNo);
            $('#address').val(address);
        });
    });
</script>
