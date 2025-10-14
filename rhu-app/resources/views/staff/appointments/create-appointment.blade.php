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
                    <h1 class="display-6 fw-500">Create New Appointment</h1>
                    <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary bg-none btn-sm">
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

                <!-- Appointment Form -->
                <form action="{{ route('admin.appointments.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="John Doe" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
                                    value="{{ old('date_of_birth') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Age -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" name="age" id="age" class="form-control"
                                    placeholder="Enter Age" value="{{ old('age') }}" required>
                            </div>
                        </div>

                        <!-- Contact Number -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_number">Contact Number</label>
                                <input type="text" name="contact_number" id="contact_number" class="form-control"
                                    value="{{ old('contact_number') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Date of Appointment -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_of_appointment">Date of Appointment</label>
                                <input type="date" name="date_of_appointment" id="date_of_appointment"
                                    class="form-control" value="{{ old('date_of_appointment') }}" required>
                            </div>
                        </div>

                        <!-- Time -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="time">Time</label>
                                <input type="time" name="time" id="time" class="form-control"
                                    value="{{ old('time') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Address -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ old('address') }}" required>
                            </div>
                        </div>

                        <!-- Service -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="service">Service</label>
                                <input type="text" name="service" id="service" class="form-control"
                                    placeholder="Enter Service" value="{{ old('service') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Emergency Contact -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emergency_contact">Emergency Contact</label>
                                <input type="text" name="emergency_contact" id="emergency_contact" class="form-control"
                                    value="{{ old('emergency_contact') }}" required>
                            </div>
                        </div>

                        <!-- Status -->
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-end mt-4">Create Appointment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
