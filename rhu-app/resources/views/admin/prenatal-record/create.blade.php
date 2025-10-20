@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2>Create Prenatal Record</h2>
                        <div class="position-absolute top-0 end-0 mt-4 me-4">
                            <a href="{{ route('admin.prenatal-record.index') }}" class="text-dark" style="font-size: 1.25rem;">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                        <br>
                        <form action="{{ route('admin.prenatal-record.store') }}" method="POST">
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
                                    <label for="appointment_id"><strong>Name</strong></label>
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

                            <!-- Prenatal Information -->
                            <h5 class="mb-3 text-primary">Prenatal Information</h5>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="weight"><strong>
                                            Weight</strong></label>
                                    <input type="text" name="weight" id="weight" class="form-control form-control-sm"
                                        required value="{{ old(key: 'weight') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="height"><strong>Height</strong></label>
                                    <input name="height" id="height" class="form-control form-control-sm"
                                        value="{{ old('height') }}"></input>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="age_of_gestation"><strong>Age of Gestation</strong></label>
                                    <input name="age_of_gestation" id="age_of_gestation"
                                        class="form-control form-control-sm"
                                        value="{{ old(key: 'age_of_gestation') }}""></input>
                                </div>
                                <div class="col-md-6">
                                    <label for="blood_pressure"><strong>Blood Pressure</strong></label>
                                    <input type="text" name="blood_pressure" id="blood_pressure" class="form-control form-control-sm"
                                        placeholder="120/80" pattern="^\d{2,3}\/\d{2,3}$" title="Enter blood pressure in format: 120/80"
                                        value="{{ old('blood_pressure') }}" required>
                                </div>
                            </div>

                            <div class="row
                                        mb-3">
                                <div class="col-md-6">
                                    <label for="nutritional_status"><strong>Nutritional Status</strong></label>
                                    <select name="nutritional_status" id="nutritional_status"
                                        class="form-control form-control-sm" required
                                        value="{{ old(key: 'nutritional_status') }}">
                                        <option value="">Select
                                            Nutritional Status</option>
                                        <option value="underweight">Underweight</option>
                                        <option value="normal">Normal</option>
                                        <option value="overweight">Overweight</option>

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="birth_plan"><strong>Birth Plan</strong></label>
                                    <input name="birth_plan" id="birth_plan" class="form-control form-control-sm"
                                        value="{{ old(key: 'birth_plan') }}""></input>
                                </div>
                            </div>

                            <!-- Pregnancy History -->
                            <div class="row
                                            mb-3">
                                <div class="col-md-6">
                                    <label for="dental_checkup"><strong>Dental Checkup</strong></label>
                                    <input name="dental_checkup" id="dental_check_up"
                                        class="form-control form-control-sm"
                                        value="{{ old(key: 'dental_check_up') }}"></input>
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
