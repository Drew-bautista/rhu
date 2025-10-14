@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Family Planning Record</h3>


                <!-- Patient Information Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h5 class="text-primary">Patient Record</h5>
                        <div>
                            <a href="{{ route('admin.family-planning.edit', $familyPlanning->id) }}"
                                class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('admin.family-planning.destroy', $familyPlanning->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $familyPlanning->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $familyPlanning->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $familyPlanning->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $familyPlanning->id }}">
                                                    Confirm
                                                    Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this data?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="position-absolute top-0 end-0 mt-4 me-4">
                        <a href="{{ route('admin.family-planning.index') }}" class="text-dark" style="font-size: 1.25rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>

                    <hr>
                    <p><strong>Name:</strong> {{ $familyPlanning->name }}</p>
                    <p><strong>Age:</strong> {{ $familyPlanning->age }}</p>
                    <p><strong>Contact:</strong> {{ ucfirst($familyPlanning->contact) }}</p>
                    <p><strong>Address:</strong> {{ $familyPlanning->address }}</p>
                    <p><strong>Date of Visit:</strong>
                        {{ \Carbon\Carbon::parse($familyPlanning->created_at)->format('Y-m-d') }}</p>
                    <p><strong>FP Counseling:</strong> {{ $familyPlanning->fp_counseling }}</p>
                    <p><strong>FP Commodity:</strong> {{ $familyPlanning->fp_commodity }}</p>
                    <p><strong>Facility:</strong> {{ $familyPlanning->facility }}</p>
                    <p><strong>Date of Follow up:</strong>
                        {{ \Carbon\Carbon::parse($familyPlanning->date_of_follow_up)->format('Y-m-d') }}</p>

                </div>
                <!-- Health Assessment Section -->
                {{-- <div class="mb-4">
                    <h5 class="text-primary">Patient Details</h5>
                    <hr>
                    <p><strong>Height:</strong> {{ $familyPlanning->height ?? 'N/A' }}</p>
                    <p><strong>Weight:</strong> {{ $familyPlanning->weight ?? 'N/A' }}</p>
                    <p><strong>Blood Pressure:</strong> {{ $familyPlanning->blood_pressure ?? 'N/A' }}</p>
                    <p><strong>Heart Rate:</strong> {{ $familyPlanning->heart_rate ?? 'N/A' }}</p>
                    <p><strong>Respiratory Rate:</strong> {{ $familyPlanning->respiratory_rate ?? 'N/A' }}</p>
                    <p><strong>Visual Acuity:</strong> {{ $familyPlanning->visual_acuity ?? 'N/A' }}</p>
                    <p><strong>Temperature:</strong> {{ $familyPlanning->temperature ?? 'N/A' }}</p> --}}
                {{-- <p><strong>Allergies:</strong> {{ $healthAssessment->allergies ?? 'N/A' }}</p>  --}}
            </div>


            <!-- Treatment Plan Section -->
            {{-- <div class="mb-4">
                    <h5 class="text-primary">Treatment Record</h5>
                    <hr>
                    <p><strong>Chief Complaint:</strong> {{ $familyPlanning->chief_complaint }}</p>
                    <p><strong>Laboratory Findings:</strong> {{ $familyPlanning->laboratory_findings }}</p>
                    <p><strong>Diagnosis:</strong> {{ $familyPlanning->assessment_diagnosis }}</p>
                    <p><strong>Medical History:</strong> {{ $familyPlanning->medical_history }}</p>
                    <p><strong>Treatment Medication:</strong> {{ $familyPlanning->medication_treatment }}</p>
                    <p>
                        <strong>Consultation Date & Time:</strong>
                        {{ \Carbon\Carbon::parse($familyPlanning->consultation_date_time)->format('F d, Y / h:i A') ?? 'N/A' }}
                    </p>
                </div> --}}
        </div>
    </div>
    </div>
@endsection
