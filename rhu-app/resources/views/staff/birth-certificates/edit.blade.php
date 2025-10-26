@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h2><i class="fas fa-edit me-2"></i>Edit Birth Certificate</h2>
                            <a href="{{ route('staff.birth-certificates.show', $birthCertificate->id) }}" class="text-dark" style="font-size: 1.25rem;">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('staff.birth-certificates.update', $birthCertificate->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Registry Number Display --}}
                            @if($birthCertificate->registry_number)
                                <div class="alert alert-info">
                                    <strong>Registry Number:</strong> {{ $birthCertificate->registry_number }}
                                </div>
                            @endif

                            {{-- Child Information --}}
                            <div class="mb-4">
                                <h5 class="text-primary"><i class="fas fa-baby me-2"></i>Child Information</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="child_first_name" class="form-control" 
                                            value="{{ old('child_first_name', $birthCertificate->child_first_name) }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Middle Name</label>
                                        <input type="text" name="child_middle_name" class="form-control" 
                                            value="{{ old('child_middle_name', $birthCertificate->child_middle_name) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="child_last_name" class="form-control" 
                                            value="{{ old('child_last_name', $birthCertificate->child_last_name) }}" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Sex <span class="text-danger">*</span></label>
                                        <select name="child_sex" class="form-control" required>
                                            <option value="">-- Select --</option>
                                            <option value="Male" {{ old('child_sex', $birthCertificate->child_sex) == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('child_sex', $birthCertificate->child_sex) == 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" name="date_of_birth" class="form-control" 
                                            value="{{ old('date_of_birth', $birthCertificate->date_of_birth ? \Carbon\Carbon::parse($birthCertificate->date_of_birth)->format('Y-m-d') : '') }}" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Time of Birth</label>
                                        <input type="time" name="time_of_birth" class="form-control" 
                                            value="{{ old('time_of_birth', $birthCertificate->time_of_birth) }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Type of Birth <span class="text-danger">*</span></label>
                                        <select name="type_of_birth" class="form-control" required>
                                            <option value="">-- Select --</option>
                                            <option value="Single" {{ old('type_of_birth', $birthCertificate->type_of_birth) == 'Single' ? 'selected' : '' }}>Single</option>
                                            <option value="Twin" {{ old('type_of_birth', $birthCertificate->type_of_birth) == 'Twin' ? 'selected' : '' }}>Twin</option>
                                            <option value="Triplet" {{ old('type_of_birth', $birthCertificate->type_of_birth) == 'Triplet' ? 'selected' : '' }}>Triplet</option>
                                            <option value="Multiple" {{ old('type_of_birth', $birthCertificate->type_of_birth) == 'Multiple' ? 'selected' : '' }}>Multiple</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Place of Birth <span class="text-danger">*</span></label>
                                        <input type="text" name="place_of_birth" class="form-control" 
                                            value="{{ old('place_of_birth', $birthCertificate->place_of_birth) }}" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Birth Weight (kg)</label>
                                        <input type="number" step="0.01" min="0" max="10" name="birth_weight" class="form-control" 
                                            value="{{ old('birth_weight', $birthCertificate->birth_weight) }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Birth Length (cm)</label>
                                        <input type="number" min="0" max="100" name="birth_length" class="form-control" 
                                            value="{{ old('birth_length', $birthCertificate->birth_length) }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Mother Information --}}
                            <div class="mb-4">
                                <h5 class="text-primary"><i class="fas fa-female me-2"></i>Mother Information</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="mother_first_name" class="form-control" 
                                            value="{{ old('mother_first_name', $birthCertificate->mother_first_name) }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Middle Name</label>
                                        <input type="text" name="mother_middle_name" class="form-control" 
                                            value="{{ old('mother_middle_name', $birthCertificate->mother_middle_name) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="mother_last_name" class="form-control" 
                                            value="{{ old('mother_last_name', $birthCertificate->mother_last_name) }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Maiden Name</label>
                                        <input type="text" name="mother_maiden_name" class="form-control" 
                                            value="{{ old('mother_maiden_name', $birthCertificate->mother_maiden_name) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" name="mother_date_of_birth" class="form-control" 
                                            value="{{ old('mother_date_of_birth', $birthCertificate->mother_date_of_birth ? \Carbon\Carbon::parse($birthCertificate->mother_date_of_birth)->format('Y-m-d') : '') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Age at Birth</label>
                                        <input type="number" min="10" max="60" name="mother_age_at_birth" class="form-control" 
                                            value="{{ old('mother_age_at_birth', $birthCertificate->mother_age_at_birth) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Citizenship</label>
                                        <input type="text" name="mother_citizenship" class="form-control" 
                                            value="{{ old('mother_citizenship', $birthCertificate->mother_citizenship) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Religion</label>
                                        <input type="text" name="mother_religion" class="form-control" 
                                            value="{{ old('mother_religion', $birthCertificate->mother_religion) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Occupation</label>
                                        <input type="text" name="mother_occupation" class="form-control" 
                                            value="{{ old('mother_occupation', $birthCertificate->mother_occupation) }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Address <span class="text-danger">*</span></label>
                                        <textarea name="mother_address" class="form-control" rows="2" required>{{ old('mother_address', $birthCertificate->mother_address) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- Father Information --}}
                            <div class="mb-4">
                                <h5 class="text-primary"><i class="fas fa-male me-2"></i>Father Information</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">First Name</label>
                                        <input type="text" name="father_first_name" class="form-control" 
                                            value="{{ old('father_first_name', $birthCertificate->father_first_name) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Middle Name</label>
                                        <input type="text" name="father_middle_name" class="form-control" 
                                            value="{{ old('father_middle_name', $birthCertificate->father_middle_name) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" name="father_last_name" class="form-control" 
                                            value="{{ old('father_last_name', $birthCertificate->father_last_name) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" name="father_date_of_birth" class="form-control" 
                                            value="{{ old('father_date_of_birth', $birthCertificate->father_date_of_birth ? \Carbon\Carbon::parse($birthCertificate->father_date_of_birth)->format('Y-m-d') : '') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Age at Birth</label>
                                        <input type="number" min="15" max="80" name="father_age_at_birth" class="form-control" 
                                            value="{{ old('father_age_at_birth', $birthCertificate->father_age_at_birth) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Citizenship</label>
                                        <input type="text" name="father_citizenship" class="form-control" 
                                            value="{{ old('father_citizenship', $birthCertificate->father_citizenship) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Religion</label>
                                        <input type="text" name="father_religion" class="form-control" 
                                            value="{{ old('father_religion', $birthCertificate->father_religion) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Occupation</label>
                                        <input type="text" name="father_occupation" class="form-control" 
                                            value="{{ old('father_occupation', $birthCertificate->father_occupation) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Address</label>
                                        <textarea name="father_address" class="form-control" rows="2">{{ old('father_address', $birthCertificate->father_address) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- Birth Attendant & Registration --}}
                            <div class="mb-4">
                                <h5 class="text-primary"><i class="fas fa-user-md me-2"></i>Birth Attendant & Registration</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Attendant Name</label>
                                        <input type="text" name="attendant_name" class="form-control" 
                                            value="{{ old('attendant_name', $birthCertificate->attendant_name) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Attendant Type</label>
                                        <select name="attendant_type" class="form-control">
                                            <option value="">-- Select --</option>
                                            <option value="Doctor" {{ old('attendant_type', $birthCertificate->attendant_type) == 'Doctor' ? 'selected' : '' }}>Doctor</option>
                                            <option value="Midwife" {{ old('attendant_type', $birthCertificate->attendant_type) == 'Midwife' ? 'selected' : '' }}>Midwife</option>
                                            <option value="Nurse" {{ old('attendant_type', $birthCertificate->attendant_type) == 'Nurse' ? 'selected' : '' }}>Nurse</option>
                                            <option value="Hilot" {{ old('attendant_type', $birthCertificate->attendant_type) == 'Hilot' ? 'selected' : '' }}>Hilot</option>
                                            <option value="Others" {{ old('attendant_type', $birthCertificate->attendant_type) == 'Others' ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control" required>
                                            <option value="">-- Select --</option>
                                            <option value="Draft" {{ old('status', $birthCertificate->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="Registered" {{ old('status', $birthCertificate->status) == 'Registered' ? 'selected' : '' }}>Registered</option>
                                            <option value="Issued" {{ old('status', $birthCertificate->status) == 'Issued' ? 'selected' : '' }}>Issued</option>
                                        </select>
                                        <small class="text-muted">Registry number will be auto-generated for Registered/Issued status</small>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Date Registered</label>
                                        <input type="date" name="date_registered" class="form-control" 
                                            value="{{ old('date_registered', $birthCertificate->date_registered ? \Carbon\Carbon::parse($birthCertificate->date_registered)->format('Y-m-d') : '') }}">
                                        <small class="text-muted">Leave blank to auto-fill with today's date</small>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Registered By</label>
                                        <input type="text" name="registered_by" class="form-control" 
                                            value="{{ old('registered_by', $birthCertificate->registered_by) }}">
                                        <small class="text-muted">Leave blank to auto-fill with your name</small>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Birth Certificate
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
