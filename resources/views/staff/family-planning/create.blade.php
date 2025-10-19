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
                    <h1 class="display-6 fw-500">Add Data</h1>
                    <a href="{{ route('staff.family-planning.index') }}" class="btn btn-md">
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


                <form action="{{ route('staff.family-planning.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="John Doe" value="{{ old('name') }}" required>
                            </div>
                        </div>


                        <!-- Age -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" name="age" id="age" class="form-control"
                                    placeholder="Enter Age" value="{{ old('age') }}" required>
                            </div>
                        </div>
                        <!-- Contact Number -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact">Contact Number</label>
                                <input type="text" name="contact" id="contact" class="form-control"
                                    value="{{ old('contact') }}" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <!-- Address -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ old('address') }}" required>
                            </div>
                        </div>

                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label>Date of Visit</label>
                                <input type="text" name="date_of_visit" class="form-control"
                                    value="{{ old('date_of_visit') }}" required>
                            </div>
                        </div> --}}

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>FP Counseling</label>
                                <input type="text" name="fp_counseling" class="form-control"
                                    value="{{ old('fp_counseling') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>FP Commodity</label>
                                <input type="text" name="fp_commodity" class="form-control"
                                    value="{{ old('fp_commodity') }}" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Facility</label>
                                <input type="text" name="facility" class="form-control" value="{{ old('facility') }}"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Follow Up</label>
                                <input type="date" name="date_of_follow_up" class="form-control"
                                    value="{{ old('date_of_follow_up') }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-end mt-4">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
