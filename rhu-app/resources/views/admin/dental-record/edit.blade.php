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
                    <h1 class="display-6 fw-500">Edit Dental Details</h1>
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
                <form action="{{ route('admin.dental-record.update', $dentalRecords->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="John Doe" value="{{ old('name', $dentalRecords->appointments ? $dentalRecords->appointments->name : 'N/A') }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="services">Services Performed</label>
                                <input type="text" name="services" id="services" class="form-control"
                                    value="{{ old('services', $dentalRecords->services) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tooth_area">Tooth/Area Involved</label>
                                <input type="text" name="tooth_area" id="tooth_area" class="form-control"
                                    value="{{ old('tooth_area', $dentalRecords->tooth_area) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="findings">Findings</label>
                                <input type="text" name="findings" id="findings" class="form-control"
                                    value="{{ old('findings', $dentalRecords->findings) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="prescription">Prescription</label>
                                <input type="text" name="prescription" id="prescription" class="form-control"
                                    value="{{ old('prescription', $dentalRecords->prescription) }}" required>
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
