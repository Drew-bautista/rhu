@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-primary">TB-DOTS Case Details</h5>
                        <div>
                            <a href="{{ route('staff.tbdots.edit', $tbdot->id) }}" class="btn btn-warning btn-sm">Update</a>
                            <a href="{{ route('staff.tbdots.index') }}" class="btn btn-secondary btn-sm">Back</a>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Patient Name</label>
                                <div>{{ $tbdot->patient_name }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Date of Birth</label>
                                <div>{{ \Carbon\Carbon::parse($tbdot->date_of_birth)->format('M d, Y') }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Age</label>
                                <div>{{ $tbdot->age }} years old</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Sex</label>
                                <div>{{ ucfirst($tbdot->sex) }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Contact Number</label>
                                <div>{{ $tbdot->contact_number }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Address</label>
                                <div>{{ $tbdot->address }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Date of Diagnosis</label>
                                <div>{{ \Carbon\Carbon::parse($tbdot->date_of_diagnosis)->format('M d, Y') }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">TB Type</label>
                                <div>{{ ucfirst(str_replace('_', ' ', $tbdot->tb_type)) }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Treatment Category</label>
                                <div>{{ ucfirst(str_replace('_', ' ', $tbdot->treatment_category)) }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Treatment Status</label>
                                <div>
                                    @if($tbdot->treatment_status == 'ongoing')
                                        <span class="badge bg-primary">Ongoing</span>
                                    @elseif($tbdot->treatment_status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($tbdot->treatment_status) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Treatment Start Date</label>
                                <div>{{ \Carbon\Carbon::parse($tbdot->treatment_start_date)->format('M d, Y') }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Treatment End Date</label>
                                <div>{{ $tbdot->treatment_end_date ? \Carbon\Carbon::parse($tbdot->treatment_end_date)->format('M d, Y') : 'Ongoing' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Remarks</label>
                                <div>{{ $tbdot->remarks ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
