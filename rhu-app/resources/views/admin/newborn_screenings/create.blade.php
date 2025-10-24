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
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h6><i class="fas fa-exclamation-triangle me-2"></i><strong>Please fix the following errors:</strong></h6>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-times-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.newborn_screenings.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                {{-- 🍼 Child Information --}}
                                <div class="col-md-12"><h5 class="text-primary mt-3">CHILD INFORMATION</h5><hr></div>
                                <div class="col-md-4 mb-3">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ old('first_name') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Middle Name</label>
                                    <input type="text" name="middle_name" class="form-control"
                                        value="{{ old('middle_name') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{ old('last_name') }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Sex <span class="text-danger">*</span></label>
                                    <select name="sex" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date" name="date_of_birth" class="form-control"
                                        value="{{ old('date_of_birth') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Time of Birth</label>
                                    <input type="time" name="time_of_birth" class="form-control"
                                        value="{{ old('time_of_birth') }}">
                                </div>

                                {{-- 👩‍🍼 MOTHER --}}
                                <div class="col-md-12"><h5 class="text-primary mt-3">MOTHER INFORMATION</h5><hr></div>
                                <div class="col-md-4 mb-3">
                                    <label>Mother's First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="mother_first_name" class="form-control"
                                        value="{{ old('mother_first_name') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Mother's Middle Name</label>
                                    <input type="text" name="mother_middle_name" class="form-control"
                                        value="{{ old('mother_middle_name') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Mother's Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="mother_last_name" class="form-control"
                                        value="{{ old('mother_last_name') }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Mother's Age</label>
                                    <input type="number" name="mother_age" class="form-control"
                                        value="{{ old('mother_age') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mother's Contact</label>
                                    <input type="text" name="mother_contact" class="form-control"
                                        value="{{ old('mother_contact') }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Mother's Address</label>
                                    <textarea name="mother_address" class="form-control" placeholder="Complete Address">{{ old('mother_address') }}</textarea>
                                </div>

                                {{-- 🧾 Screening Details --}}
                                <div class="col-md-12"><h5 class="text-primary mt-3">SCREENING DETAILS</h5><hr></div>
                                <div class="col-md-4 mb-3">
                                    <label>Screening Date <span class="text-danger">*</span></label>
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
                                <div class="col-md-12"><h5 class="text-primary mt-3">SCREENING RESULTS</h5><hr></div>
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
                                    <label>Result Status <span class="text-danger">*</span></label>
                                    <select name="result_status" class="form-control" required>
                                        <option value="">-- Select Result --</option>
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
                                <div class="col-md-12"><h5 class="text-primary mt-3">HEALTH PROVIDER</h5><hr></div>
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

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Save Newborn Screening</button>
                                <a href="{{ route('admin.newborn_screenings.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    // Add real-time validation
    form.addEventListener('submit', function(e) {
        let hasErrors = false;
        const errors = [];
        
        // Validate required fields
        const requiredFields = [
            { name: 'first_name', label: 'Child\'s First Name' },
            { name: 'last_name', label: 'Child\'s Last Name' },
            { name: 'sex', label: 'Sex' },
            { name: 'date_of_birth', label: 'Date of Birth' },
            { name: 'mother_first_name', label: 'Mother\'s First Name' },
            { name: 'mother_last_name', label: 'Mother\'s Last Name' },
            { name: 'screening_date', label: 'Screening Date' },
            { name: 'result_status', label: 'Result Status' }
        ];
        
        requiredFields.forEach(field => {
            const input = form.querySelector(`[name="${field.name}"]`);
            if (input && !input.value.trim()) {
                errors.push(`${field.label} is required.`);
                input.classList.add('is-invalid');
                hasErrors = true;
            } else if (input) {
                input.classList.remove('is-invalid');
            }
        });
        
        // Validate names (letters and spaces only)
        const nameFields = ['first_name', 'middle_name', 'last_name', 'mother_first_name', 'mother_middle_name', 'mother_last_name'];
        nameFields.forEach(fieldName => {
            const input = form.querySelector(`[name="${fieldName}"]`);
            if (input && input.value.trim()) {
                const nameRegex = /^[a-zA-Z\s]+$/;
                if (!nameRegex.test(input.value)) {
                    errors.push(`${fieldName.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())} should only contain letters and spaces.`);
                    input.classList.add('is-invalid');
                    hasErrors = true;
                } else {
                    input.classList.remove('is-invalid');
                }
            }
        });
        
        // Validate dates (not in future)
        const dateFields = ['date_of_birth', 'screening_date', 'sample_collection_at'];
        const today = new Date().toISOString().split('T')[0];
        dateFields.forEach(fieldName => {
            const input = form.querySelector(`[name="${fieldName}"]`);
            if (input && input.value && input.value > today) {
                errors.push(`${fieldName.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())} cannot be in the future.`);
                input.classList.add('is-invalid');
                hasErrors = true;
            } else if (input) {
                input.classList.remove('is-invalid');
            }
        });
        
        // Validate birth weight
        const birthWeight = form.querySelector('[name="birth_weight"]');
        if (birthWeight && birthWeight.value) {
            const weight = parseFloat(birthWeight.value);
            if (isNaN(weight) || weight < 0.5 || weight > 10) {
                errors.push('Birth weight must be between 0.5 and 10 kg.');
                birthWeight.classList.add('is-invalid');
                hasErrors = true;
            } else {
                birthWeight.classList.remove('is-invalid');
            }
        }
        
        // Validate mother's age
        const motherAge = form.querySelector('[name="mother_age"]');
        if (motherAge && motherAge.value) {
            const age = parseInt(motherAge.value);
            if (isNaN(age) || age < 12 || age > 60) {
                errors.push('Mother\'s age must be between 12 and 60 years.');
                motherAge.classList.add('is-invalid');
                hasErrors = true;
            } else {
                motherAge.classList.remove('is-invalid');
            }
        }
        
        // Show errors if any
        if (hasErrors) {
            e.preventDefault();
            
            // Create or update error alert
            let errorAlert = document.querySelector('.validation-errors');
            if (!errorAlert) {
                errorAlert = document.createElement('div');
                errorAlert.className = 'alert alert-danger alert-dismissible fade show validation-errors';
                errorAlert.innerHTML = `
                    <h6><i class="fas fa-exclamation-triangle me-2"></i><strong>Please fix the following errors:</strong></h6>
                    <ul class="mb-0" id="error-list"></ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                form.insertBefore(errorAlert, form.firstChild);
            }
            
            const errorList = errorAlert.querySelector('#error-list');
            errorList.innerHTML = errors.map(error => `<li>${error}</li>`).join('');
            
            // Scroll to top to show errors
            errorAlert.scrollIntoView({ behavior: 'smooth' });
        }
    });
    
    // Remove validation classes on input
    form.addEventListener('input', function(e) {
        if (e.target.classList.contains('is-invalid')) {
            e.target.classList.remove('is-invalid');
        }
    });
});
</script>
