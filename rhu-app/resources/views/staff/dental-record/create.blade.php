@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2>Create Dental Record</h2>
                        <br>
                        <form action="{{ route('staff.dental-record.store') }}" method="POST">
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

                            <!-- Dental Details -->
                            <h5 class="mb-3 text-primary">Dental Details</h5>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="services"><strong>
                                            Services Performed</strong></label>
                                    <input type="text" name="services" id="services"
                                        class="form-control form-control-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="findings"><strong>Findings</strong></label>
                                    <input name="findings" id="findings" class="form-control form-control-sm"></input>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="tooth_area"><strong>Tooth/Area Involved</strong></label>
                                    <input name="tooth_area" id="tooth_area" class="form-control form-control-sm"></input>
                                </div>
                                <div class="col-md-6">
                                    <label for="prescription"><strong>Prescription</strong></label>
                                    <textarea name="prescription" id="prescription" class="form-control form-control-sm"></textarea>
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
