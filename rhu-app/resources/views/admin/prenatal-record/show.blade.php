@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Prenatal Record</h3>


                <!-- Patient Information Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h5 class="text-primary">Patient Details</h5>
                        <div>

                            <form action="{{ route('admin.prenatal-record.destroy', $prenatalRecord->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $prenatalRecord->id }}">
                                    Delete
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $prenatalRecord->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $prenatalRecord->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $prenatalRecord->id }}">
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
                        <a href="{{ route('admin.prenatal-record.index') }}" class="text-dark" style="font-size: 1.25rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>

                    <hr>
                    <p>
                        <strong>Name:</strong> {{ $prenatalRecord->appointments->name }}
                    </p>
                    <p>
                        <strong>Age:</strong> {{ $prenatalRecord->appointments->age }}
                    </p>
                    <p>
                        <strong>Contact:</strong> {{ $prenatalRecord->appointments->contact_number }}
                    </p>
                    <p>
                        <strong>Address:</strong> {{ $prenatalRecord->appointments->address }}
                    </p>
                    <p>
                        <strong>Service:</strong> {{ $prenatalRecord->appointments->service }}
                    </p>
                    <p>
                        <strong>Appointment Date & Time:</strong>

                        {{ \Carbon\Carbon::parse($prenatalRecord->appointments->date_of_appointment)->format('F j, Y') }} /
                        {{ \Carbon\Carbon::parse($prenatalRecord->appointments->time)->format('h:i A') }}
                    </p>
                    <p><strong>Date of Birth:</strong>
                        {{ \Carbon\Carbon::parse($prenatalRecord->appointments->name_of_birth)->format('Y-m-d') }}</p>
                    {{-- <p><strong>Gender:</strong> {{ ucfirst($prenatalRecord->sex) }}</p> --}}
                    <p>
                        <strong>Emergency Contact:</strong> {{ $prenatalRecord->appointments->emergency_contact }}
                    </p>

                </div>
                <!-- Health Assessment Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-primary">Physical Examination</h5>
                        <a href="{{ route('admin.prenatal-record.edit', $prenatalRecord->id) }}"
                            class="btn btn-warning btn-sm">Update Data</a>
                    </div>

                    <hr>
                    <p>
                        <strong>Height:</strong> {{ $prenatalRecord->height ?? 'N/A' }}
                    </p>
                    <p>
                        <strong>Weight:</strong> {{ $prenatalRecord->weight ?? 'N/A' }}
                    </p>
                    <p>
                        <strong>Age of Gestation:</strong> {{ $prenatalRecord->age_of_gestation ?? 'N/A' }}
                    </p>
                    <p><strong>Blood Pressure:</strong> {{ $prenatalRecord->blood_pressure ?? 'N/A' }}</p>
                    <p><strong>Nutrition:</strong> {{ $prenatalRecord->nutritional_status ?? 'N/A' }}</p>
                    <p><strong>Birth Plan:</strong> {{ $prenatalRecord->birth_plan ?? 'N/A' }}</p>
                    <p><strong>Dental:</strong> {{ $prenatalRecord->dental_checkup ?? 'N/A' }}</p>

                    {{-- <p><strong>Allergies:</strong> {{ $healthAssessment->allergies ?? 'N/A' }}</p>  --}}
                </div>


                <!-- Treatment Plan Section -->
                {{-- <div class="mb-4">
                    <h5 class="text-primary">Treatment</h5>
                    <hr>
                    <p><strong>Chief Complaint:</strong> {{ $prenatalRecord->chief_complaint }}</p>
                    <p><strong>Laboratory Findings:</strong> {{ $prenatalRecord->laboratory_findings }}</p>
                    <p><strong>Diagnosis:</strong> {{ $prenatalRecord->assessment_diagnosis }}</p>
                    <p><strong>Medical History:</strong> {{ $prenatalRecord->medical_history }}</p>
                    <p><strong>Treatment Medication:</strong> {{ $prenatalRecord->medication_treatment }}</p>
                    <p>
                        <strong>Consultation Date & Time:</strong>
                        {{ \Carbon\Carbon::parse($prenatalRecord->consultation_date_time)->format('F d, Y / h:i A') ?? 'N/A' }}
                    </p>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
