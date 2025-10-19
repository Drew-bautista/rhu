@extends('layout.app')

<style>
    label {
        font-weight: bold;
        margin-top: 0.5em;
    }
</style>

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="d-flex align-items-center justify-content-between">
                    <h1 class="display-6 fw-500">Edit Prenatal</h1>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary bg-none btn-sm">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Edit Form -->
                <form action="{{ route('admin.prenatal-record.update', $prenatalRecord->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="John Doe" value="{{ old('name', $prenatalRecord->appointments->name) }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="height">Height</label>
                                <input type="text" name="height" id="height" class="form-control"
                                    value="{{ old('height', $prenatalRecord->height) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="weight">Weight</label>
                                <input type="text" name="weight" id="weight" class="form-control"
                                    value="{{ old('weight', $prenatalRecord->weight) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="age_of_gestation">Age of Gestation</label>
                                <input type="number" name="age_of_gestation" id="age_of_gestation" class="form-control"
                                    value="{{ old('age_of_gestation', $prenatalRecord->age_of_gestation) }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_number">Blood Pressure</label>
                                <input type="text" name="blood_pressure" id="blood_pressure" class="form-control"
                                    value="{{ old('blood_pressure', $prenatalRecord->blood_pressure) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nutritional_status">Nutritional Status</label>
                                <select name="nutritional_status" id="nutritional_status" class="form-control" required>
                                    <option value="" disabled
                                        {{ old('nutritional_status', $prenatalRecord->nutritional_status) == null ? 'selected' : '' }}>
                                        Select Nutritional Status
                                    </option>
                                    <option value="underweight"
                                        {{ old('nutritional_status', $prenatalRecord->nutritional_status) == 'underweight' ? 'selected' : '' }}>
                                        Underweight
                                    </option>
                                    <option value="normal"
                                        {{ old('nutritional_status', $prenatalRecord->nutritional_status) == 'normal' ? 'selected' : '' }}>
                                        Normal
                                    </option>
                                    <option value="overweight"
                                        {{ old('nutritional_status', $prenatalRecord->nutritional_status) == 'overweight' ? 'selected' : '' }}>
                                        Overweight
                                    </option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="service">Birth Plan</label>
                                <input type="text" name="service" id="service" class="form-control"
                                    placeholder="Enter Service" value="{{ old('service', $prenatalRecord->birth_plan) }}"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dental_checkup">Dental Checkup</label>
                                <input type="text" name="dental_checkup" id="dental_checkup" class="form-control"
                                    placeholder="Enter Dental_checkup"
                                    value="{{ old('dental_checkup', $prenatalRecord->dental_checkup) }}" required>
                            </div>
                        </div>
                    </div>



                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-warning float-end mt-4">Update Appointment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
