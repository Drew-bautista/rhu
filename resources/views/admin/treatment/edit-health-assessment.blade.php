@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h2>Update Health Assessment</h2>
                            <form action="{{ route('admin.health.update', $treatment->health_assessment->id) }}"
                                method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="heart_rate"><strong>Height</strong></label>
                                        <input type="text" name="height" id="height" class="form-control"
                                            value="{{ $treatment->health_assessment->height }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="heart_rate"><strong>Weight
                                                {{ $treatment->health_assessment->id }}</strong></label>
                                        <input type="text" name="weight" id="weight" class="form-control"
                                            value="{{ $treatment->health_assessment->weight }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="blood_pressure"><strong>Blood Pressure</strong></label>
                                        <input type="text" name="blood_pressure" id="blood_pressure" class="form-control"
                                            value="{{ $treatment->health_assessment->blood_pressure }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="heart_rate"><strong>Heart Rate</strong></label>
                                        <input type="text" name="heart_rate" id="heart_rate" class="form-control"
                                            value="{{ $treatment->health_assessment->heart_rate }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="medical_conditions"><strong>Medical Conditions</strong></label>
                                        <input type="text" name="medical_conditions" id="medical_conditions"
                                            class="form-control"
                                            value="{{ $treatment->health_assessment->medical_conditions }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="medical_history"><strong>Medical History</strong></label>
                                        <input type="text" name="medical_history" id="medical_history"
                                            class="form-control"
                                            value="{{ $treatment->health_assessment->medical_history }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="symptoms"><strong>Symptoms</strong></label>
                                        <input type="text" name="symptoms" id="symptoms" class="form-control"
                                            value="{{ $treatment->health_assessment->symptoms }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="allergies"><strong>Allergies</strong></label>
                                        <input type="text" name="allergies" id="allergies" class="form-control"
                                            value="{{ $treatment->health_assessment->allergies }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-warning float-end ">Update Assessment</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary float-end me-2">Go Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
