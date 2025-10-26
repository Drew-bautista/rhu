@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3 class="mb-0">Cbc Result</h3>
                    <div>
                        <a href="{{ route('admin.cbc-results.index') }}" class="text-dark" style="font-size: 1.25rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <!-- Patient Information Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-primary">Patient Details</h5>
                        <div>
                            <a href="{{ route('admin.cbc-results.edit', $cbcResult->id) }}" class="btn btn-warning btn-sm">Update Data</a>
                        </div>
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
                        <a href="{{ route('admin.cbc-results.edit', $cbcResult->id) }}"
                            class="btn btn-warning btn-sm">Update Data</a>
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
