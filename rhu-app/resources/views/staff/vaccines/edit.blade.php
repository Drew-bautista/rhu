@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container position-relative">
            <div class="card">
                <div class="card-body">
                    <h2>Edit Vaccine Record</h2>
                    <div class="position-absolute top-0 end-0 mt-4 me-4">
                        <a href="{{ route('staff.vaccines.index') }}" class="text-dark" style="font-size:1.25rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <br>

                    <form action="{{ route('staff.vaccines.update', $vaccine->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="appointment_id" class="form-label">Linked Appointment (optional)</label>
                                <select name="appointment_id" id="appointment_id" class="form-select">
                                    <option value="">-- Select Appointment --</option>
                                    @foreach($appointments as $appointment)
                                        <option value="{{ $appointment->id }}" 
                                            {{ old('appointment_id', $vaccine->appointment_id) == $appointment->id ? 'selected' : '' }}>
                                            {{ $appointment->name }} ({{ \Carbon\Carbon::parse($appointment->date_of_appointment)->format('M d, Y') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="patient_name" class="form-label">Patient Name <span class="text-danger">*</span></label>
                                <input type="text" name="patient_name" id="patient_name" class="form-control" 
                                    value="{{ old('patient_name', $vaccine->patient_name) }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" 
                                    value="{{ old('date_of_birth', $vaccine->date_of_birth ? $vaccine->date_of_birth->format('Y-m-d') : '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                                <input type="number" name="age" id="age" class="form-control" 
                                    value="{{ old('age', $vaccine->age) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="age_group" class="form-label">Age Group <span class="text-danger">*</span></label>
                                <select name="age_group" id="age_group" class="form-select" required>
                                    <option value="">-- Select Age Group --</option>
                                    <option value="infant" {{ old('age_group', $vaccine->age_group) == 'infant' ? 'selected' : '' }}>Infant</option>
                                    <option value="child" {{ old('age_group', $vaccine->age_group) == 'child' ? 'selected' : '' }}>Child</option>
                                    <option value="adolescent" {{ old('age_group', $vaccine->age_group) == 'adolescent' ? 'selected' : '' }}>Adolescent</option>
                                    <option value="adult" {{ old('age_group', $vaccine->age_group) == 'adult' ? 'selected' : '' }}>Adult</option>
                                    <option value="senior" {{ old('age_group', $vaccine->age_group) == 'senior' ? 'selected' : '' }}>Senior</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="sex" class="form-label">Sex <span class="text-danger">*</span></label>
                                <select name="sex" id="sex" class="form-select" required>
                                    <option value="">-- Select Sex --</option>
                                    <option value="male" {{ old('sex', $vaccine->sex) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('sex', $vaccine->sex) == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('sex', $vaccine->sex) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="contact_number" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                <input type="text" name="contact_number" id="contact_number" class="form-control" 
                                    value="{{ old('contact_number', $vaccine->contact_number) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                <input type="text" name="address" id="address" class="form-control" 
                                    value="{{ old('address', $vaccine->address) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="vaccine_type" class="form-label">Vaccine Type <span class="text-danger">*</span></label>
                                <input type="text" name="vaccine_type" id="vaccine_type" class="form-control" 
                                    value="{{ old('vaccine_type', $vaccine->vaccine_type) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="dose_number" class="form-label">Dose Number <span class="text-danger">*</span></label>
                                <input type="text" name="dose_number" id="dose_number" class="form-control" 
                                    value="{{ old('dose_number', $vaccine->dose_number) }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="date_administered" class="form-label">Date Administered <span class="text-danger">*</span></label>
                                <input type="date" name="date_administered" id="date_administered" class="form-control" 
                                    value="{{ old('date_administered', $vaccine->date_administered ? $vaccine->date_administered->format('Y-m-d') : '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="next_dose_date" class="form-label">Next Dose Date</label>
                                <input type="date" name="next_dose_date" id="next_dose_date" class="form-control" 
                                    value="{{ old('next_dose_date', $vaccine->next_dose_date ? $vaccine->next_dose_date->format('Y-m-d') : '') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="administered_by" class="form-label">Administered By <span class="text-danger">*</span></label>
                                <input type="text" name="administered_by" id="administered_by" class="form-control" 
                                    value="{{ old('administered_by', $vaccine->administered_by) }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="batch_number" class="form-label">Batch Number</label>
                                <input type="text" name="batch_number" id="batch_number" class="form-control" 
                                    value="{{ old('batch_number', $vaccine->batch_number) }}">
                            </div>
                            <div class="col-md-4">
                                <label for="expiry_date" class="form-label">Expiry Date</label>
                                <input type="date" name="expiry_date" id="expiry_date" class="form-control" 
                                    value="{{ old('expiry_date', $vaccine->expiry_date ? $vaccine->expiry_date->format('Y-m-d') : '') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="adverse_reactions" class="form-label">Adverse Reactions</label>
                                <input type="text" name="adverse_reactions" id="adverse_reactions" class="form-control" 
                                    value="{{ old('adverse_reactions', $vaccine->adverse_reactions) }}">
                            </div>

                            <div class="col-12">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea name="remarks" id="remarks" rows="3" class="form-control">{{ old('remarks', $vaccine->remarks) }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">Update Vaccine Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
