@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-primary">Patient / Appointment Details</h5>
                        <div>
                            <a href="{{ route('staff.animal-bite.edit', $animalBiteCase->id) }}" class="btn btn-warning btn-sm">Update</a>
                            <a href="{{ route('staff.animal-bite.index') }}" class="btn btn-secondary btn-sm">Back</a>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Patient Name</label>
                                <div>{{ $animalBiteCase->appointment->name ?? 'N/A' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Date of Incident</label>
                                <div>{{ $animalBiteCase->date_of_incident ? \Carbon\Carbon::parse($animalBiteCase->date_of_incident)->format('M d, Y') : '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Animal Type</label>
                                <div>{{ $animalBiteCase->animal_type ?? '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Animal Ownership</label>
                                <div>{{ $animalBiteCase->animal_ownership ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Bite Site</label>
                                <div>{{ $animalBiteCase->bite_site ?? '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Bite Category</label>
                                <div>{{ $animalBiteCase->bite_category ?? '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">ARV Dose</label>
                                <div>{{ $animalBiteCase->arv_dose ?? '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Remarks</label>
                                <div>{{ $animalBiteCase->remarks ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Animal Vaccination Status</label>
                                <div>{{ $animalBiteCase->animal_vaccination_status ?? '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Animal Behavior</label>
                                <div>{{ $animalBiteCase->animal_behavior ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">First Consultation Date</label>
                                <div>{{ $animalBiteCase->first_consultation_date ? \Carbon\Carbon::parse($animalBiteCase->first_consultation_date)->format('M d, Y') : '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">ARV Date</label>
                                <div>{{ $animalBiteCase->arv_date ? \Carbon\Carbon::parse($animalBiteCase->arv_date)->format('M d, Y') : '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">RIG Administered</label>
                                <div>{{ $animalBiteCase->rig_administered ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
