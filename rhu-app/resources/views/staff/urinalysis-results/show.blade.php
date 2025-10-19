@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Urinalysis Result</h3>

                <!-- Patient Information Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-primary">Patient Details</h5>
                        <div>
                            <form action="{{ route('staff.urinalysis-results.destroy', $urinalysisResult->id) }}"
                                method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                {{-- <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $urinalysisResult->id }}">
                                    Delete
                                </button> --}}

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $urinalysisResult->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $urinalysisResult->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $urinalysisResult->id }}">
                                                    Confirm Deletion
                                                </h5>
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
                            </form>
                        </div>
                    </div>

                    <div class="position-absolute top-0 end-0 mt-4 me-4">
                        <a href="{{ route('staff.urinalysis-results.index') }}" class="text-dark"
                            style="font-size: 1.25rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>

                    <hr>
                    <p><strong>Name:</strong> {{ $urinalysisResult->appointments->name }}</p>
                    <p><strong>Age:</strong> {{ $urinalysisResult->appointments->age }}</p>
                    <p><strong>Contact:</strong> {{ $urinalysisResult->appointments->contact_number }}</p>
                    <p><strong>Address:</strong> {{ $urinalysisResult->appointments->address }}</p>
                    <p><strong>Service:</strong> {{ $urinalysisResult->appointments->service }}</p>
                    <p>
                        <strong>Appointment Date & Time:</strong>
                        {{ \Carbon\Carbon::parse($urinalysisResult->appointments->date_of_appointment)->format('F j, Y') }}
                        /
                        {{ \Carbon\Carbon::parse($urinalysisResult->appointments->time)->format('h:i A') }}
                    </p>
                </div>

                <!-- Urinalysis Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-primary">Urinalysis Results</h5>
                        {{-- <a href="{{ route('admin.urinalysis-results.edit', $urinalysisResult->id) }}"
                            class="btn btn-warning btn-sm">Update Data</a> --}}
                    </div>

                    <hr>

                    <!-- Physical Exam -->
                    {{-- <h6 class="text-secondary">Physical Examination</h6> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Color:</strong> {{ $urinalysisResult->color ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Transparency:</strong> {{ $urinalysisResult->transparency ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Specific Gravity:</strong> {{ $urinalysisResult->specific_gravity ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>pH:</strong> {{ $urinalysisResult->ph ?? 'N/A' }}</p>
                        </div>
                        {{-- </div> --}}

                        <!-- Chemical Exam -->
                        {{-- <h6 class="text-secondary mt-3">Chemical Examination</h6>
                    <div class="row"> --}}
                        <div class="col-md-6">
                            <p><strong>Protein:</strong> {{ $urinalysisResult->protein ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Glucose:</strong> {{ $urinalysisResult->glucose ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Ketones:</strong> {{ $urinalysisResult->ketones ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Bilirubin:</strong> {{ $urinalysisResult->bilirubin ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Urobilinogen:</strong> {{ $urinalysisResult->urobilinogen ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Nitrite:</strong> {{ $urinalysisResult->nitrite ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Leukocyte Esterase:</strong> {{ $urinalysisResult->leukocyte_esterase ?? 'N/A' }}
                            </p>
                        </div>
                        {{-- </div> --}}

                        <!-- Microscopic Exam -->
                        {{-- <h6 class="text-secondary mt-3">Microscopic Examination</h6>
                    <div class="row"> --}}
                        <div class="col-md-6">
                            <p><strong>RBC:</strong> {{ $urinalysisResult->rbc ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>WBC:</strong> {{ $urinalysisResult->wbc ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Epithelial Cells:</strong> {{ $urinalysisResult->epithelial_cells ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Bacteria:</strong> {{ $urinalysisResult->bacteria ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Crystals:</strong> {{ $urinalysisResult->crystals ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Casts:</strong> {{ $urinalysisResult->casts ?? 'N/A' }}</p>
                        </div>
                        {{-- </div> --}}

                        <p><strong>Remarks:</strong> {{ $urinalysisResult->remarks ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endsection
