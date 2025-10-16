    @extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-primary">Vaccine Record Details</h5>
                        <div>
                            <a href="{{ route('staff.vaccines.edit', $vaccine->id) }}" class="btn btn-warning btn-sm">Update</a>
                            <a href="{{ route('staff.vaccines.index') }}" class="btn btn-secondary btn-sm">Back</a>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Patient Name</label>
                                <div>{{ $vaccine->patient_name }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Date of Birth</label>
                                <div>{{ \Carbon\Carbon::parse($vaccine->date_of_birth)->format('M d, Y') }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Age</label>
                                <div>{{ $vaccine->age }} years old</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Age Group</label>
                                <div>{{ ucfirst($vaccine->age_group) }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Sex</label>
                                <div>{{ ucfirst($vaccine->sex) }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Contact Number</label>
                                <div>{{ $vaccine->contact_number }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Address</label>
                                <div>{{ $vaccine->address }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Vaccine Type</label>
                                <div>{{ $vaccine->vaccine_type }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Dose Number</label>
                                <div>{{ $vaccine->dose_number }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Date Administered</label>
                                <div>{{ \Carbon\Carbon::parse($vaccine->date_administered)->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Next Dose Date</label>
                                <div>{{ $vaccine->next_dose_date ? \Carbon\Carbon::parse($vaccine->next_dose_date)->format('M d, Y') : 'Completed' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Administered By</label>
                                <div>{{ $vaccine->administered_by }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Batch Number</label>
                                <div>{{ $vaccine->batch_number ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Expiry Date</label>
                                <div>{{ $vaccine->expiry_date ? \Carbon\Carbon::parse($vaccine->expiry_date)->format('M d, Y') : '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Adverse Reactions</label>
                                <div>{{ $vaccine->adverse_reactions ?? '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Remarks</label>
                                <div>{{ $vaccine->remarks ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
