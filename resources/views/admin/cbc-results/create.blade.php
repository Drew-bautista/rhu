@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2>Create CBC Result</h2>
                        <div class="position-absolute top-0 end-0 mt-4 me-4">
                            <a href="{{ route('admin.cbc-results.index') }}" class="text-dark" style="font-size: 1.25rem;">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                        <br>
                        <form action="{{ route('admin.cbc-results.store') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- Personal Details -->
                            <h5 class="mb-3 text-primary">Patient Information</h5>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="appointment_id"><strong>Patient Name</strong></label>
                                    <select class="selectpicker form-control form-control-sm" id="appointment_id"
                                        data-live-search="true" name="appointment_id" required>
                                        <option></option>
                                        @foreach ($appointments as $appointment)
                                            <option value="{{ $appointment->id }}" data-age="{{ $appointment->age }}"
                                                data-contact-number="{{ $appointment->contact_number }}"
                                                data-address="{{ $appointment->address }}"
                                                data-service="{{ $appointment->service }}">
                                                {{ $appointment->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="age"><strong>Age</strong></label>
                                    <input type="text" name="age" id="age" class="form-control form-control-sm"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="contact_number"><strong>Contact</strong></label>
                                    <input type="text" name="contact_number" id="contact_number"
                                        class="form-control form-control-sm" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="address"><strong>Address</strong></label>
                                    <input type="text" name="address" id="address" class="form-control form-control-sm"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="service"><strong>Services</strong></label>
                                    <input type="text" name="service" id="service" class="form-control form-control-sm"
                                        disabled>
                                </div>
                            </div>

                            <h5 class="mb-3 text-primary">CBC Details</h5>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="hemoglobin"><strong>Hemoglobin</strong></label>
                                    <input type="number" step="0.01" name="hemoglobin" id="hemoglobin"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label for="hematocrit"><strong>Hematocrit</strong></label>
                                    <input type="number" step="0.01" name="hematocrit" id="hematocrit"
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="rbc_count"><strong>RBC Count</strong></label>
                                    <input type="number" step="0.01" name="rbc_count" id="rbc_count"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label for="wbc_count"><strong>WBC Count</strong></label>
                                    <input type="number" step="0.01" name="wbc_count" id="wbc_count"
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="platelet_count"><strong>Platelet Count</strong></label>
                                    <input type="number" step="0.01" name="platelet_count" id="platelet_count"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label for="mcv"><strong>MCV</strong></label>
                                    <input type="number" step="0.01" name="mcv" id="mcv"
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="mch"><strong>MCH</strong></label>
                                    <input type="number" step="0.01" name="mch" id="mch"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label for="mchc"><strong>MCHC</strong></label>
                                    <input type="number" step="0.01" name="mchc" id="mchc"
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="neutrophils"><strong>Neutrophils</strong></label>
                                    <input type="number" step="0.01" name="neutrophils" id="neutrophils"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label for="lymphocytes"><strong>Lymphocytes</strong></label>
                                    <input type="number" step="0.01" name="lymphocytes" id="lymphocytes"
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="monocytes"><strong>Monocytes</strong></label>
                                    <input type="number" step="0.01" name="monocytes" id="monocytes"
                                        class="form-control form-control-sm">
                                </div>

                                <div class="col-md-6">
                                    <label for="eosinophils"><strong>Eosinophils</strong></label>
                                    <input type="number" step="0.01" name="eosinophils" id="eosinophils"
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="basophils"><strong>Basophils</strong></label>
                                    <input type="number" step="0.01" name="basophils" id="basophils"
                                        class="form-control form-control-sm">
                                </div>

                                <div class="col-md-6">
                                    <label for="newborn_screening"><strong>Newborn Screening</strong></label>
                                    <input type="text" name="newborn_screening" id="newborn_screening"
                                        class="form-control form-control-sm">
                                </div>

                                <div class="col-md-6">
                                    <label for="hepa_b_screening"><strong>Hepa B Screening</strong></label>
                                    <input type="text" name="hepa_b_screening" id="hepa_b_screening"
                                        class="form-control form-control-sm">
                                </div>

                                <div class="col-md-6">
                                    <label for="fasting_blood_sugar"><strong>Fasting Blood Sugar</strong></label>
                                    <input type="number" step="0.01" name="fasting_blood_sugar"
                                        id="fasting_blood_sugar" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-6">
                                    <label for="cholesterol"><strong>Cholesterol</strong></label>
                                    <input type="number" step="0.01" name="cholesterol" id="cholesterol"
                                        class="form-control form-control-sm">
                                </div>

                                <div class="col-md-6">
                                    <label for="remarks"><strong>Remarks</strong></label>
                                    <textarea name="remarks" id="remarks" class="form-control form-control-sm"></textarea>
                                </div>

                            </div>



                            <!-- Submit Button -->
                            <div class="d-flex float-end">
                                <button type="submit" class="btn btn-sm btn-primary ">Save</button>
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
        $('#appointment_id').change(function() {
            // Get the selected option
            const selectedOption = $(this).find(':selected');

            // Extract data attributes
            const age = selectedOption.data('age');
            const contactNo = selectedOption.data('contact-number');
            const address = selectedOption.data('address');
            const service = selectedOption.data('service');
            // Populate the fields
            $('#age').val(age);
            $('#contact_number').val(contactNo);
            $('#address').val(address);
            $('#service').val(service);
        });
    });
</script>
