@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full py-3 p-1 p-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <h2>Update Patient Info</h2>
                    <form action="{{ route('admin.patient.update', $patient->id) }}" method="POST">
                        @csrf
                        <div class="row my-3">
                            <div class="col-md-6">
                                <label for="firstname"><strong>First Name</strong></label>
                                <input type="text" name="firstname" id="firstname" class="form-control"
                                    value="{{ $patient->firstname }}" required>
                            </div>
                            {{-- <div class="col-md-4">
                                    <label for="middlename"><strong>Middle Name</strong></label>
                                    <input type="text" name="middlename" id="middlename" class="form-control" value="{{ $user->middlename }}" required>
                                </div> --}}
                            <div class="col-md-6">
                                <label for="lastname"><strong>Last Name</strong></label>
                                <input type="text" name="lastname" id="lastname" class="form-control"
                                    value="{{ $patient->lastname }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            {{-- <div class="col-md-6">
                                    <label for="email"><strong>Email</strong></label>
                                    <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" disabled>
                                </div> --}}
                            <div class="col-md-6">
                                <label for="sex"><strong>Sex</strong></label>
                                <select name="sex" id="sex" class="form-control">
                                    <option value="Male" {{ $patient->sex == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $patient->sex == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="birthdate"><strong>Birthdate</strong></label>
                                <input type="date" name="birthdate" id="birthdate" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($patient->birthdate)->format('Y-m-d') }}" required>
                            </div>




                            {{-- <div class="col-md-6">
                                    <label for="year"><strong>Year</strong></label>
                                    <input type="text" name="year" id="year" class="form-control" value="{{ $user->year }}" required>
                                </div> --}}
                        </div>
                        <div class="row mb-3">
                            {{-- <div class="col-md-6">
                                <label for="section"><strong>Section</strong></label>
                                <input type="text" name="section" id="section" class="form-control"
                                    value="{{ $user->section }}" required>
                            </div> --}}
                            <div class="col-md-6">
                                <label for="contact_no"><strong>Contact number</strong></label>
                                <input type="text" name="contact_no" id="contact_no" class="form-control"
                                    value="{{ $patient->contact_no }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="emergency_contact"><strong>Emergency contact number</strong></label>
                                <input type="text" name="emergency_contact" id="emergency_contact" class="form-control"
                                    value="{{ $patient->emergency_contact }}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning float-end ">Update <span
                                class="d-none d-sm-inline">Patient Info</span></button>
                        <button type="button" onclick="history.back()" class="btn btn-secondary float-end me-2">Go
                            Back</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
