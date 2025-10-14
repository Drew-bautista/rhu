@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Add New Vaccine Record</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.vaccines.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="patient_name" class="form-label">Patient Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('patient_name') is-invalid @enderror" 
                                           id="patient_name" name="patient_name" value="{{ old('patient_name') }}" required>
                                    @error('patient_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="appointment_id" class="form-label">Related Appointment (Optional)</label>
                                    <select class="form-control @error('appointment_id') is-invalid @enderror" 
                                            id="appointment_id" name="appointment_id">
                                        <option value="">-- Select Appointment --</option>
                                        @foreach($appointments as $appointment)
                                            <option value="{{ $appointment->id }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>
                                                {{ $appointment->name }} - {{ $appointment->date_of_appointment }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('appointment_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                           id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('age') is-invalid @enderror" 
                                           id="age" name="age" value="{{ old('age') }}" required>
                                    @error('age')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="age_group" class="form-label">Age Group <span class="text-danger">*</span></label>
                                    <select class="form-control @error('age_group') is-invalid @enderror" 
                                            id="age_group" name="age_group" required>
                                        <option value="">-- Select Age Group --</option>
                                        <option value="infant" {{ old('age_group') == 'infant' ? 'selected' : '' }}>Infant (0-1 year)</option>
                                        <option value="child" {{ old('age_group') == 'child' ? 'selected' : '' }}>Child (2-12 years)</option>
                                        <option value="adolescent" {{ old('age_group') == 'adolescent' ? 'selected' : '' }}>Adolescent (13-17 years)</option>
                                        <option value="adult" {{ old('age_group') == 'adult' ? 'selected' : '' }}>Adult (18-59 years)</option>
                                        <option value="senior" {{ old('age_group') == 'senior' ? 'selected' : '' }}>Senior (60+ years)</option>
                                    </select>
                                    @error('age_group')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="sex" class="form-label">Sex <span class="text-danger">*</span></label>
                                    <select class="form-control @error('sex') is-invalid @enderror" 
                                            id="sex" name="sex" required>
                                        <option value="">-- Select Sex --</option>
                                        <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('sex') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('sex')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="contact_number" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('contact_number') is-invalid @enderror" 
                                           id="contact_number" name="contact_number" value="{{ old('contact_number') }}" 
                                           placeholder="09XXXXXXXXX" required>
                                    @error('contact_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                           id="address" name="address" value="{{ old('address') }}" required>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <h5 class="mb-3">Vaccine Information</h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="vaccine_type" class="form-label">Vaccine Type <span class="text-danger">*</span></label>
                                    <select class="form-control @error('vaccine_type') is-invalid @enderror" 
                                            id="vaccine_type" name="vaccine_type" required>
                                        <option value="">-- Select Vaccine --</option>
                                        <optgroup label="Infant/Child Vaccines">
                                            <option value="BCG">BCG (Tuberculosis)</option>
                                            <option value="Hepatitis B">Hepatitis B</option>
                                            <option value="DPT">DPT (Diphtheria, Pertussis, Tetanus)</option>
                                            <option value="OPV">OPV (Oral Polio Vaccine)</option>
                                            <option value="IPV">IPV (Inactivated Polio Vaccine)</option>
                                            <option value="MMR">MMR (Measles, Mumps, Rubella)</option>
                                            <option value="Rotavirus">Rotavirus</option>
                                            <option value="PCV">PCV (Pneumococcal)</option>
                                        </optgroup>
                                        <optgroup label="Adult/Senior Vaccines">
                                            <option value="COVID-19">COVID-19</option>
                                            <option value="Influenza">Influenza (Flu)</option>
                                            <option value="Pneumonia">Pneumonia</option>
                                            <option value="Hepatitis A">Hepatitis A</option>
                                            <option value="HPV">HPV (Human Papillomavirus)</option>
                                            <option value="Tetanus">Tetanus Booster</option>
                                        </optgroup>
                                    </select>
                                    @error('vaccine_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="dose_number" class="form-label">Dose Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('dose_number') is-invalid @enderror" 
                                           id="dose_number" name="dose_number" value="{{ old('dose_number') }}" 
                                           placeholder="e.g., 1st dose, 2nd dose, Booster" required>
                                    @error('dose_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="date_administered" class="form-label">Date Administered <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('date_administered') is-invalid @enderror" 
                                           id="date_administered" name="date_administered" value="{{ old('date_administered', date('Y-m-d')) }}" required>
                                    @error('date_administered')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="next_dose_date" class="form-label">Next Dose Date</label>
                                    <input type="date" class="form-control @error('next_dose_date') is-invalid @enderror" 
                                           id="next_dose_date" name="next_dose_date" value="{{ old('next_dose_date') }}">
                                    @error('next_dose_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="administered_by" class="form-label">Administered By <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('administered_by') is-invalid @enderror" 
                                           id="administered_by" name="administered_by" 
                                           value="{{ old('administered_by', Auth::user()->firstname . ' ' . Auth::user()->lastname) }}" required>
                                    @error('administered_by')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="batch_number" class="form-label">Batch Number</label>
                                    <input type="text" class="form-control @error('batch_number') is-invalid @enderror" 
                                           id="batch_number" name="batch_number" value="{{ old('batch_number') }}">
                                    @error('batch_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="expiry_date" class="form-label">Expiry Date</label>
                                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" 
                                           id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
                                    @error('expiry_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="adverse_reactions" class="form-label">Adverse Reactions</label>
                                    <input type="text" class="form-control @error('adverse_reactions') is-invalid @enderror" 
                                           id="adverse_reactions" name="adverse_reactions" value="{{ old('adverse_reactions') }}"
                                           placeholder="None / Describe if any">
                                    @error('adverse_reactions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea class="form-control @error('remarks') is-invalid @enderror" 
                                          id="remarks" name="remarks" rows="3">{{ old('remarks') }}</textarea>
                                @error('remarks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.vaccines.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save Vaccine Record
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-calculate age based on date of birth
        document.getElementById('date_of_birth').addEventListener('change', function() {
            const dob = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - dob.getFullYear();
            const monthDiff = today.getMonth() - dob.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                age--;
            }
            
            document.getElementById('age').value = age;
            
            // Auto-select age group
            let ageGroup = '';
            if (age < 1) ageGroup = 'infant';
            else if (age <= 12) ageGroup = 'child';
            else if (age <= 17) ageGroup = 'adolescent';
            else if (age <= 59) ageGroup = 'adult';
            else ageGroup = 'senior';
            
            document.getElementById('age_group').value = ageGroup;
        });
    </script>
@endsection
