@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-5" id="createHealthModal">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h2>Health Assessment</h2>
                            <form action="{{ route('admin.health-record.store') }}" method="POST">
                                @csrf

                                <!-- Personal Details -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="request_type" class="form-label fw-bolder">Patient Name</label>
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

                                <!-- Health Information -->
                                <h5 class="mb-3">Health Information</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="height"><strong>Height</strong></label>
                                        <input type="text" name="height" id="height" class="form-control"
                                            value="{{ old('height') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="weight"><strong>Weight</strong></label>
                                        <input type="text" name="weight" id="weight" class="form-control"
                                            value="{{ old('weight') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="blood_pressure"><strong>Blood Pressure</strong></label>
                                        <input type="text" name="blood_pressure" id="blood_pressure" class="form-control"
                                            value="{{ old('blood_pressure') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="heart_rate"><strong>Heart Rate</strong></label>
                                        <input type="text" name="heart_rate" id="heart_rate" class="form-control"
                                            value="{{ old('heart_rate') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="medical_conditions"><strong>Respiratory Rate</strong></label>
                                        <input type="text" name="respiratory_rate" id="respiratory_rate"
                                            class="form-control" value="{{ old('respiratory_rate') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="medical_history"><strong>Visual Acuity</strong></label>
                                        <input type="text" name="visual_acuity" id="visual_acuity" class="form-control"
                                            value="{{ old('visual_acuity') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="symptoms"><strong>Temperature</strong></label>
                                        <input type="text" name="temperature" id="temperature" class="form-control"
                                            value="{{ old('temperature') }}">
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <label for="allergies"><strong>Allergies</strong></label>
                                        <input type="text" name="allergies" id="allergies" class="form-control"
                                            value="{{ old('allergies') }}">
                                    </div> --}}
                                </div>
                                <div class="d-flex mt-3 float-end">
                                    <button type="submit" class="btn btn-primary mt-3">Save Assessment</button>
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
