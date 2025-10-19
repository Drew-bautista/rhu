@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>Edit TB-DOTS Case</h2>
    <form action="{{ route('admin.tbdots.update', $tbdot->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="appointment_id" class="form-label">Related Appointment (Optional)</label>
            <select name="appointment_id" id="appointment_id" class="form-control">
                <option value="">-- Select Appointment --</option>
                @foreach($appointments as $appointment)
                    <option value="{{ $appointment->id }}" {{ $tbdot->appointment_id == $appointment->id ? 'selected' : '' }}>
                        {{ $appointment->name }} - {{ $appointment->date_of_appointment }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="patient_name" class="form-label">Patient Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="patient_name" value="{{ $tbdot->patient_name }}" required>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="date_of_birth" value="{{ $tbdot->date_of_birth->format('Y-m-d') }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="age" value="{{ $tbdot->age }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="sex" class="form-label">Sex <span class="text-danger">*</span></label>
                <select name="sex" class="form-control" required>
                    <option value="male" {{ $tbdot->sex == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $tbdot->sex == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $tbdot->sex == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="contact_number" class="form-label">Contact Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contact_number" value="{{ $tbdot->contact_number }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="address" value="{{ $tbdot->address }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="date_of_diagnosis" class="form-label">Date of Diagnosis <span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="date_of_diagnosis" value="{{ $tbdot->date_of_diagnosis->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="tb_type" class="form-label">Type of TB <span class="text-danger">*</span></label>
            <select name="tb_type" class="form-control" required>
                <option value="pulmonary" {{ $tbdot->tb_type == 'pulmonary' ? 'selected' : '' }}>Pulmonary</option>
                <option value="extra_pulmonary" {{ $tbdot->tb_type == 'extra_pulmonary' ? 'selected' : '' }}>Extra Pulmonary</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="treatment_category" class="form-label">Treatment Category <span class="text-danger">*</span></label>
            <select name="treatment_category" class="form-control" required>
                <option value="category_1" {{ $tbdot->treatment_category == 'category_1' ? 'selected' : '' }}>Category 1</option>
                <option value="category_2" {{ $tbdot->treatment_category == 'category_2' ? 'selected' : '' }}>Category 2</option>
                <option value="category_3" {{ $tbdot->treatment_category == 'category_3' ? 'selected' : '' }}>Category 3</option>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="treatment_start_date" class="form-label">Treatment Start Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="treatment_start_date" value="{{ $tbdot->treatment_start_date->format('Y-m-d') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="treatment_end_date" class="form-label">Treatment End Date</label>
                <input type="date" class="form-control" name="treatment_end_date" value="{{ $tbdot->treatment_end_date ? $tbdot->treatment_end_date->format('Y-m-d') : '' }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="treatment_status" class="form-label">Treatment Status <span class="text-danger">*</span></label>
            <select name="treatment_status" class="form-control" required>
                <option value="ongoing" {{ $tbdot->treatment_status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="completed" {{ $tbdot->treatment_status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="defaulted" {{ $tbdot->treatment_status == 'defaulted' ? 'selected' : '' }}>Defaulted</option>
                <option value="failed" {{ $tbdot->treatment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                <option value="died" {{ $tbdot->treatment_status == 'died' ? 'selected' : '' }}>Died</option>
                <option value="transferred_out" {{ $tbdot->treatment_status == 'transferred_out' ? 'selected' : '' }}>Transferred Out</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea class="form-control" name="remarks" rows="3">{{ $tbdot->remarks }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.tbdots.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Update TB-DOTS Case
            </button>
        </div>
    </form>
</div>
@endsection
