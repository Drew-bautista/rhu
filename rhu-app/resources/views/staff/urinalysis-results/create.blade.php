@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2>Create Urinalysis Result</h2>
                        <div class="position-absolute top-0 end-0 mt-4 me-4">
                            <a href="{{ route('staff.urinalysis-results.index') }}" class="text-dark"
                                style="font-size: 1.25rem;">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                        <br>

                        <form action="{{ route('staff.urinalysis-results.store') }}" method="POST">
                            @csrf

                            {{-- Validation Errors --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Patient Information -->
                            <h5 class="mb-3 text-primary">Patient Information</h5>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="appointment_id"><strong>Patient Name</strong></label>
                                    <select class="selectpicker form-control form-control-sm" id="appointment_id"
                                        data-live-search="true" name="appointment_id" required>
                                        <option disabled selected>-- Select Patient --</option>
                                        @foreach ($appointments as $appointment)
                                            @if (!$appointment->urinalysisResult)
                                                <option value="{{ $appointment->id }}" data-age="{{ $appointment->age }}"
                                                    data-contact-number="{{ $appointment->contact_number }}"
                                                    data-address="{{ $appointment->address }}"
                                                    data-service="{{ $appointment->service }}">
                                                    {{ $appointment->name }}
                                                </option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="age"><strong>Age</strong></label>
                                    <input type="text" id="age" class="form-control form-control-sm" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="contact_number"><strong>Contact</strong></label>
                                    <input type="text" id="contact_number" class="form-control form-control-sm" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="address"><strong>Address</strong></label>
                                    <input type="text" id="address" class="form-control form-control-sm" readonly>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="service"><strong>Service</strong></label>
                                    <input type="text" id="service" class="form-control form-control-sm" readonly>
                                </div>
                            </div>

                            <!-- Urinalysis Details -->
                            <h5 class="mb-3 text-primary">Urinalysis Details</h5>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="color"><strong>Color</strong></label>
                                    <select name="color" id="color" class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <option>Yellow</option>
                                        <option>Amber</option>
                                        <option>Dark Yellow</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="transparency"><strong>Transparency</strong></label>
                                    <select name="transparency" id="transparency" class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <option>Clear</option>
                                        <option>Slightly Cloudy</option>
                                        <option>Cloudy</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="specific_gravity"><strong>Specific Gravity</strong></label>
                                    <input type="number" name="specific_gravity" id="specific_gravity"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label for="ph"><strong>pH</strong></label>
                                    <input type="number" name="ph" id="ph"
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="protein"><strong>Protein</strong></label>
                                    <select name="protein" id="protein" class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <option>Negative</option>
                                        <option>Trace</option>
                                        <option>Positive</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="glucose"><strong>Glucose</strong></label>
                                    <select name="glucose" id="glucose" class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <option>Negative</option>
                                        <option>Trace</option>
                                        <option>Positive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="ketones"><strong>Ketones</strong></label>
                                    <select name="ketones" id="ketones" class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <option>Negative</option>
                                        <option>Positive</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="bilirubin"><strong>Bilirubin</strong></label>
                                    <select name="bilirubin" id="bilirubin" class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <option>Negative</option>
                                        <option>Positive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="urobilinogen"><strong>Urobilinogen</strong></label>
                                    <input type="text" name="urobilinogen" id="urobilinogen"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label for="nitrite"><strong>Nitrite</strong></label>
                                    <select name="nitrite" id="nitrite" class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <option>Negative</option>
                                        <option>Positive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="leukocyte_esterase"><strong>Leukocyte Esterase</strong></label>
                                    <select name="leukocyte_esterase" id="leukocyte_esterase"
                                        class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <option>Negative</option>
                                        <option>Positive</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="rbc"><strong>RBC</strong></label>
                                    <input type="text" name="rbc" id="rbc"
                                        class="form-control form-control-sm" placeholder="e.g. 0-2 /hpf">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="wbc"><strong>WBC</strong></label>
                                    <input type="text" name="wbc" id="wbc"
                                        class="form-control form-control-sm" placeholder="e.g. 0-5 /hpf">
                                </div>
                                <div class="col-md-6">
                                    <label for="epithelial_cells"><strong>Epithelial Cells</strong></label>
                                    <input type="text" name="epithelial_cells" id="epithelial_cells"
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="bacteria"><strong>Bacteria</strong></label>
                                    <select name="bacteria" id="bacteria" class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <option>None</option>
                                        <option>Few</option>
                                        <option>Moderate</option>
                                        <option>Many</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="crystals"><strong>Crystals</strong></label>
                                    <input type="text" name="crystals" id="crystals"
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="casts"><strong>Casts</strong></label>
                                    <input type="text" name="casts" id="casts"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label for="remarks"><strong>Remarks</strong></label>
                                    <textarea name="remarks" id="remarks" class="form-control form-control-sm" rows="2"></textarea>
                                </div>
                            </div>

                            <!-- Submit Button -->
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
