@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>Add TBDOTS Case</h2>
    <form action="{{ route('admin.tbdots.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="appointment_id" class="form-label">Related Appointment (Optional)</label>
            <select name="appointment_id" id="appointment_id" class="form-control">
                <option value="">-- Select Appointment --</option>
                @foreach($appointments as $appointment)
                    <option value="{{ $appointment->id }}">{{ $appointment->name }} - {{ $appointment->date_of_appointment }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="patient_name" class="form-label">Patient Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="patient_name" required>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="date_of_birth" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="age" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="sex" class="form-label">Sex <span class="text-danger">*</span></label>
                <select name="sex" class="form-control" required>
                    <option value="">-- Select --</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="contact_number" class="form-label">Contact Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contact_number" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="address" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="date_of_diagnosis" class="form-label">Date of Diagnosis</label>
            <input type="date" class="form-control" name="date_of_diagnosis" required>
        </div>

        <div class="mb-3">
            <label for="tb_type" class="form-label">Type of TB <span class="text-danger">*</span></label>
            <select name="tb_type" class="form-control" required>
                <option value="">-- Select Type --</option>
                <option value="pulmonary">Pulmonary</option>
                <option value="extra_pulmonary">Extra Pulmonary</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="treatment_category" class="form-label">Treatment Category <span class="text-danger">*</span></label>
            <select name="treatment_category" class="form-control" required>
                <option value="">-- Select Category --</option>
                <option value="category_1">Category 1</option>
                <option value="category_2">Category 2</option>
                <option value="category_3">Category 3</option>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="treatment_start_date" class="form-label">Treatment Start Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="treatment_start_date" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="treatment_end_date" class="form-label">Treatment End Date</label>
                <input type="date" class="form-control" name="treatment_end_date">
            </div>
        </div>

        <div class="mb-3">
            <label for="treatment_status" class="form-label">Treatment Status <span class="text-danger">*</span></label>
            <select name="treatment_status" class="form-control" required>
                <option value="ongoing">Ongoing</option>
                <option value="completed">Completed</option>
                <option value="defaulted">Defaulted</option>
                <option value="failed">Failed</option>
                <option value="died">Died</option>
                <option value="transferred_out">Transferred Out</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea class="form-control" name="remarks" rows="3"></textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.tbdots.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save TB-DOTS Case
            </button>
        </div>
        <a href="{{ route('admin.tbdots.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
