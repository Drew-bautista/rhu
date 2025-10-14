@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2>Create Newborn Screening</h2>
                        <div class="position-absolute top-0 end-0 mt-4 me-4">
                            <a href="{{ route('admin.newborn_screenings.index') }}" class="text-dark"
                                style="font-size: 1.25rem;">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                        <br>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.newborn_screenings.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                {{-- 🍼 Newborn Info --}}
                                <div class="col-md-4 mb-3">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ old('first_name') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Middle Name</label>
                                    <input type="text" name="middle_name" class="form-control"
                                        value="{{ old('middle_name') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{ old('last_name') }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Sex</label>
                                    <select name="sex" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control"
                                        value="{{ old('date_of_birth') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Time of Birth</label>
                                    <input type="time" name="time_of_birth" class="form-control"
                                        value="{{ old('time_of_birth') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Birth Weight (kg)</label>
                                    <input type="number" step="0.01" name="birth_weight" class="form-control"
                                        value="{{ old('birth_weight') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Gestational Age (weeks)</label>
                                    <input type="number" name="gestational_age" class="form-control"
                                        value="{{ old('gestational_age') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Place of Birth</label>
                                    <input type="text" name="place_of_birth" class="form-control"
                                        value="{{ old('place_of_birth') }}">
                                </div>

                                {{-- 👩‍🍼 Mother Info --}}
                                <div class="col-md-4 mb-3">
                                    <label>Mother's Name</label>
                                    <input type="text" name="mother_name" class="form-control"
                                        value="{{ old('mother_name') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Mother's Age</label>
                                    <input type="number" name="mother_age" class="form-control"
                                        value="{{ old('mother_age') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Mother's Contact</label>
                                    <input type="text" name="mother_contact" class="form-control"
                                        value="{{ old('mother_contact') }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Mother's Address</label>
                                    <textarea name="mother_address" class="form-control">{{ old('mother_address') }}</textarea>
                                </div>

                                {{-- 🧾 Screening Details --}}
                                <div class="col-md-4 mb-3">
                                    <label>Screening Date</label>
                                    <input type="date" name="screening_date" class="form-control"
                                        value="{{ old('screening_date') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Facility</label>
                                    <input type="text" name="facility" class="form-control"
                                        value="{{ old('facility') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Kit No.</label>
                                    <input type="text" name="kit_no" class="form-control" value="{{ old('kit_no') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Sample Collection Date & Time</label>
                                    <input type="datetime-local" name="sample_collection_at" class="form-control"
                                        value="{{ old('sample_collection_at') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Specimen Type</label>
                                    <input type="text" name="specimen_type" class="form-control"
                                        value="{{ old('specimen_type') }}">
                                </div>

                                {{-- 🧪 Screening Results --}}
                                <div class="col-md-12 mb-3">
                                    <label for="conditions_tested" class="form-label">
                                        Conditions Tested
                                        <small class="text-muted">(Type multiple, separated by comma)</small>
                                    </label>

                                    <input type="text" name="conditions_tested" id="conditions_tested"
                                        class="form-control" placeholder="Ex: Congenital Hypothyroidism, G6PD Deficiency"
                                        value="{{ old('conditions_tested') }}">

                                    <small class="text-muted d-block mt-1">
                                        Separate conditions with a comma (,)
                                    </small>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Result Status</label>
                                    <select name="result_status" class="form-control" required>
                                        <option value="Normal" {{ old('result_status') == 'Normal' ? 'selected' : '' }}>
                                            Normal</option>
                                        <option value="Positive"
                                            {{ old('result_status') == 'Positive' ? 'selected' : '' }}>
                                            Positive</option>
                                        <option value="Retest" {{ old('result_status') == 'Retest' ? 'selected' : '' }}>
                                            Retest</option>
                                    </select>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label>Remarks</label>
                                    <textarea name="remarks" class="form-control">{{ old('remarks') }}</textarea>
                                </div>

                                {{-- 👨‍⚕️ Health Provider --}}
                                <div class="col-md-6 mb-3">
                                    <label>Provider Name</label>
                                    <input type="text" name="provider_name" class="form-control"
                                        value="{{ old('provider_name') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Provider Role</label>
                                    <input type="text" name="provider_role" class="form-control"
                                        value="{{ old('provider_role') }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-end">Save</button>
                            {{-- <a href="{{ route('newborn_screenings.index') }}" class="btn btn-secondary">Cancel</a> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
