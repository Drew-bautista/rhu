@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container position-relative">
            <div class="card">
                <div class="card-body">
                    <h2>Add Newborn Screening</h2>
                    <div class="position-absolute top-0 end-0 mt-4 me-4">
                        <a href="{{ route('staff.newborn_screenings.index') }}" class="text-dark" style="font-size:1.25rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <br>

                    <form action="{{ route('staff.newborn_screenings.store') }}" method="POST">
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

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" id="first_name" class="form-control" 
                                    value="{{ old('first_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" id="last_name" class="form-control" 
                                    value="{{ old('last_name') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="sex" class="form-label">Sex <span class="text-danger">*</span></label>
                                <select name="sex" id="sex" class="form-select" required>
                                    <option value="">-- Select Sex --</option>
                                    <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" 
                                    value="{{ old('date_of_birth') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="mother_name" class="form-label">Mother's Name <span class="text-danger">*</span></label>
                                <input type="text" name="mother_name" id="mother_name" class="form-control" 
                                    value="{{ old('mother_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="screening_date" class="form-label">Screening Date <span class="text-danger">*</span></label>
                                <input type="date" name="screening_date" id="screening_date" class="form-control" 
                                    value="{{ old('screening_date') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="result_status" class="form-label">Result Status <span class="text-danger">*</span></label>
                                <select name="result_status" id="result_status" class="form-select" required>
                                    <option value="">-- Select Status --</option>
                                    <option value="normal" {{ old('result_status') == 'normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="abnormal" {{ old('result_status') == 'abnormal' ? 'selected' : '' }}>Abnormal</option>
                                    <option value="pending" {{ old('result_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea name="remarks" id="remarks" rows="3" class="form-control">{{ old('remarks') }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">Save Newborn Screening</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
