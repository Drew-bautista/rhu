@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="d-flex align-items-center justify-content-between">
                    <h1 class="display-6 fw-500">Edit Family Planning</h1>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary bg-none btn-sm">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>

            <div class="card-body">
                {{-- Display validation errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Display success message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Display error message --}}
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.family-planning.update', $familyPlanning->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $familyPlanning->name) }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact"
                                    value="{{ old('contact', $familyPlanning->contact) }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="age" name="age"
                                    value="{{ old('age', $familyPlanning->age) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address', $familyPlanning->address) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                <label for="fp_counseling" class="form-label">FP Counseling</label>
                                <input type="text" class="form-control" id="fp_counseling" name="fp_counseling"
                                    value="{{ old('fp_counseling', $familyPlanning->fp_counseling) }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                <label for="fp_commodity" class="form-label">FP Commodity</label>
                                <input type="text" class="form-control" id="fp_commodity" name="fp_commodity"
                                    value="{{ old('fp_commodity', $familyPlanning->fp_commodity) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">

                            <div class="mb-3">
                                <label for="facility" class="form-label">Facility</label>
                                <input type="text" class="form-control" id="facility" name="facility"
                                    value="{{ old('facility', $familyPlanning->facility) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                <label for="date_of_follow_up" class="form-label">Follow Up Date</label>
                                <input type="date" class="form-control" id="date_of_follow_up" name="date_of_follow_up"
                                    value="{{ old('date_of_follow_up', $familyPlanning->date_of_follow_up ? $familyPlanning->date_of_follow_up->format('Y-m-d') : '') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-warning float-end">Update data</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
