@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2>Create Animal Bite Case</h2>
                        <div class="position-absolute top-0 end-0 mt-4 me-4">
                            <a href="{{ route('admin.animal-bite.index') }}" class="text-dark" style="font-size:1.25rem;">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                        <br>

                        <form action="{{ route('admin.animal-bite.store') }}" method="POST">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Patient Info -->
                            <h5 class="mb-3 text-primary">Patient Information</h5>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="appointment_id"><strong>Patient Name</strong></label>
                                    <select class="selectpicker form-control form-control-sm" id="appointment_id"
                                        data-live-search="true" name="appointment_id">
                                        <option disabled selected>-- Select Patient --</option>
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
                                    <label><strong>Age</strong></label>
                                    <input type="text" id="age" class="form-control form-control-sm" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label><strong>Contact</strong></label>
                                    <input type="text" id="contact_number" class="form-control form-control-sm" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label><strong>Address</strong></label>
                                    <input type="text" id="address" class="form-control form-control-sm" readonly>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label><strong>Service</strong></label>
                                    <input type="text" id="service" class="form-control form-control-sm" readonly>
                                </div>
                            </div>

                            <!-- Animal Bite Details -->
                            <h5 class="mb-3 text-primary">Animal Bite Details</h5>
                            <hr>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="date_of_incident"><strong>Date of Incident</strong></label>
                                    <input type="date" name="date_of_incident" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label for="animal_type"><strong>Animal Type</strong></label>
                                    <input type="text" name="animal_type" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="animal_ownership"><strong>Animal Ownership</strong></label>
                                    <select name="animal_ownership" class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <option>Owned</option>
                                        <option>Stray</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="animal_vaccination_status"><strong>Vaccination Status</strong></label>
                                    <select name="animal_vaccination_status" class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <option>Vaccinated</option>
                                        <option>Unvaccinated</option>
                                        <option>Unknown</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="animal_behavior"><strong>Animal Behavior</strong></label>
                                    <select name="animal_behavior" class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <option>Normal</option>
                                        <option>Aggressive</option>
                                        <option>Rabid Signs</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="bite_site"><strong>Bite Site</strong></label>
                                    <input type="text" name="bite_site" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="bite_category"><strong>Bite Category</strong></label>
                                    <select name="bite_category" class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <option>I</option>
                                        <option>II</option>
                                        <option>III</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="wound_description"><strong>Wound Description</strong></label>
                                    <textarea name="wound_description" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="first_consultation_date"><strong>First Consultation Date</strong></label>
                                    <input type="date" name="first_consultation_date"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label for="arv_dose"><strong>ARV Dose</strong></label>
                                    <input type="text" name="arv_dose" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="arv_date"><strong>ARV Date</strong></label>
                                    <input type="date" name="arv_date" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label for="rig_administered"><strong>RIG Administered</strong></label>
                                    <input type="text" name="rig_administered" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="remarks"><strong>Remarks</strong></label>
                                    <textarea name="remarks" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>

                            <div class="d-flex float-end">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#appointment_id').change(function() {
            const selectedOption = $(this).find(':selected');
            $('#age').val(selectedOption.data('age'));
            $('#contact_number').val(selectedOption.data('contact-number'));
            $('#address').val(selectedOption.data('address'));
            $('#service').val(selectedOption.data('service'));
        });
    });
</script>
