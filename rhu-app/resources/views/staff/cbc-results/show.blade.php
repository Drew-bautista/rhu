@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Cbc Result</h3>


                <!-- Patient Information Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h5 class="text-primary">Patient Details</h5>
                        <div>

                            <form action="{{ route('staff.cbc-results.destroy', $cbcResult->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                {{-- <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $cbcResult->id }}">
                                    Delete
                                </button> --}}

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $cbcResult->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $cbcResult->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $cbcResult->id }}">
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
                        <a href="{{ route('staff.cbc-results.index') }}" class="text-dark" style="font-size: 1.25rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>

                    <hr>
                    <p>
                        <strong>Name:</strong> {{ $cbcResult->appointments->name }}
                    </p>
                    <p>
                        <strong>Age:</strong> {{ $cbcResult->appointments->age }}
                    </p>
                    <p>
                        <strong>Contact:</strong> {{ $cbcResult->appointments->contact_number }}
                    </p>
                    <p>
                        <strong>Address:</strong> {{ $cbcResult->appointments->address }}
                    </p>
                    <p>
                        <strong>Service:</strong> {{ $cbcResult->appointments->service }}
                    </p>
                    <p>
                        <strong>Appointment Date & Time:</strong>

                        {{ \Carbon\Carbon::parse($cbcResult->appointments->date_of_appointment)->format('F j, Y') }} /
                        {{ \Carbon\Carbon::parse($cbcResult->appointments->time)->format('h:i A') }}
                    </p>
                    <p><strong>Date of Birth:</strong>
                        {{ \Carbon\Carbon::parse($cbcResult->appointments->name_of_birth)->format('Y-m-d') }}</p>
                    {{-- <p><strong>Gender:</strong> {{ ucfirst($cbcResult->sex) }}</p> --}}
                    <p>
                        <strong>Emergency Contact:</strong> {{ $cbcResult->appointments->emergency_contact }}
                    </p>

                </div>
                <!-- Health Assessment Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-primary">Cbc Results</h5>
                        {{-- <a href="{{ route('staff.cbc-results.edit', $cbcResult->id) }}"
                            class="btn btn-warning btn-sm">Update Data</a> --}}
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <strong>Hemoglobin:</strong> {{ $cbcResult->hemoglobin ?? 'N/A' }}
                            </p>
                            <p>
                                <strong>Hematocrit:</strong> {{ $cbcResult->hematocrit ?? 'N/A' }}
                            </p>
                            <p>
                                <strong>RBC Count:</strong> {{ $cbcResult->rbc_count ?? 'N/A' }}
                            </p>
                            <p>
                                <strong>WBC Count:</strong> {{ $cbcResult->wbc_count ?? 'N/A' }}
                            </p>
                            <p>
                                <strong>Platelet Count:</strong> {{ $cbcResult->platelet_count ?? 'N/A' }}
                            </p>
                            <p>
                                <strong>MCV:</strong> {{ $cbcResult->mcv ?? 'N/A' }}
                            </p>
                            <p>
                                <strong>MCH:</strong> {{ $cbcResult->mch ?? 'N/A' }}
                            </p>
                            <p>
                                <strong>MCHC:</strong> {{ $cbcResult->mchc ?? 'N/A' }}
                            </p>
                            <p>
                                <strong>Neutrophils:</strong> {{ $cbcResult->neutrophils ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="col-md-6">

                            <p>
                                <strong>Lymphocytes:</strong> {{ $cbcResult->lymphocytes ?? 'N/A' }}
                            </p>
                            <p>
                                <strong>Monocytes:</strong> {{ $cbcResult->monocytes ?? 'N/A' }}
                            </p>
                            <p>
                                <strong>Eosinophils:</strong> {{ $cbcResult->eosinophils ?? 'N/A' }}
                            </p>
                            <p>
                                <strong>Basophils:</strong> {{ $cbcResult->basophils ?? 'N/A' }}
                            </p>
                            <p>
                                <strong>Remarks:</strong> {{ $cbcResult->remarks ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
