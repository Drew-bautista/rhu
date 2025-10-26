@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3 class="mb-0"><i class="fas fa-certificate me-2"></i>Birth Certificate Details</h3>
                    <div>
                        <a href="{{ route('staff.birth-certificates.index') }}" class="text-dark" style="font-size: 1.25rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                {{-- Registry Number & Status --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6><strong>Registry Number:</strong></h6>
                        @if($birthCertificate->registry_number)
                            <span class="badge bg-info fs-6">{{ $birthCertificate->registry_number }}</span>
                        @else
                            <span class="text-muted">Not Assigned</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h6><strong>Status:</strong></h6>
                        @if($birthCertificate->status == 'Draft')
                            <span class="badge bg-secondary fs-6">Draft</span>
                        @elseif($birthCertificate->status == 'Registered')
                            <span class="badge bg-success fs-6">Registered</span>
                        @elseif($birthCertificate->status == 'Issued')
                            <span class="badge bg-primary fs-6">Issued</span>
                        @endif
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="mb-4">
                    <a href="{{ route('staff.birth-certificates.edit', $birthCertificate->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button class="btn btn-info" onclick="window.print()">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>

                {{-- Child Information --}}
                <div class="mb-4">
                    <h5 class="text-primary"><i class="fas fa-baby me-2"></i>Child Information</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>First Name:</strong> {{ $birthCertificate->child_first_name }}</p>
                            <p><strong>Middle Name:</strong> {{ $birthCertificate->child_middle_name ?? 'N/A' }}</p>
                            <p><strong>Last Name:</strong> {{ $birthCertificate->child_last_name }}</p>
                            <p><strong>Sex:</strong> {{ $birthCertificate->child_sex }}</p>
                            <p><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($birthCertificate->date_of_birth)->format('F j, Y') }}</p>
                            @if($birthCertificate->time_of_birth)
                                <p><strong>Time of Birth:</strong> {{ $birthCertificate->time_of_birth }}</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p><strong>Place of Birth:</strong> {{ $birthCertificate->place_of_birth }}</p>
                            <p><strong>Type of Birth:</strong> {{ $birthCertificate->type_of_birth }}</p>
                            @if($birthCertificate->birth_order)
                                <p><strong>Birth Order:</strong> {{ $birthCertificate->birth_order }}</p>
                            @endif
                            @if($birthCertificate->birth_weight)
                                <p><strong>Birth Weight:</strong> {{ $birthCertificate->birth_weight }} kg</p>
                            @endif
                            @if($birthCertificate->birth_length)
                                <p><strong>Birth Length:</strong> {{ $birthCertificate->birth_length }} cm</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Mother Information --}}
                <div class="mb-4">
                    <h5 class="text-primary"><i class="fas fa-female me-2"></i>Mother Information</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>First Name:</strong> {{ $birthCertificate->mother_first_name }}</p>
                            <p><strong>Middle Name:</strong> {{ $birthCertificate->mother_middle_name ?? 'N/A' }}</p>
                            <p><strong>Last Name:</strong> {{ $birthCertificate->mother_last_name }}</p>
                            @if($birthCertificate->mother_maiden_name)
                                <p><strong>Maiden Name:</strong> {{ $birthCertificate->mother_maiden_name }}</p>
                            @endif
                            @if($birthCertificate->mother_date_of_birth)
                                <p><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($birthCertificate->mother_date_of_birth)->format('F j, Y') }}</p>
                            @endif
                            @if($birthCertificate->mother_age_at_birth)
                                <p><strong>Age at Birth:</strong> {{ $birthCertificate->mother_age_at_birth }} years old</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p><strong>Address:</strong> {{ $birthCertificate->mother_address }}</p>
                            @if($birthCertificate->mother_citizenship)
                                <p><strong>Citizenship:</strong> {{ $birthCertificate->mother_citizenship }}</p>
                            @endif
                            @if($birthCertificate->mother_religion)
                                <p><strong>Religion:</strong> {{ $birthCertificate->mother_religion }}</p>
                            @endif
                            @if($birthCertificate->mother_occupation)
                                <p><strong>Occupation:</strong> {{ $birthCertificate->mother_occupation }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Father Information --}}
                @if($birthCertificate->father_first_name)
                    <div class="mb-4">
                        <h5 class="text-primary"><i class="fas fa-male me-2"></i>Father Information</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>First Name:</strong> {{ $birthCertificate->father_first_name }}</p>
                                <p><strong>Middle Name:</strong> {{ $birthCertificate->father_middle_name ?? 'N/A' }}</p>
                                <p><strong>Last Name:</strong> {{ $birthCertificate->father_last_name }}</p>
                                @if($birthCertificate->father_date_of_birth)
                                    <p><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($birthCertificate->father_date_of_birth)->format('F j, Y') }}</p>
                                @endif
                                @if($birthCertificate->father_age_at_birth)
                                    <p><strong>Age at Birth:</strong> {{ $birthCertificate->father_age_at_birth }} years old</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if($birthCertificate->father_address)
                                    <p><strong>Address:</strong> {{ $birthCertificate->father_address }}</p>
                                @endif
                                @if($birthCertificate->father_citizenship)
                                    <p><strong>Citizenship:</strong> {{ $birthCertificate->father_citizenship }}</p>
                                @endif
                                @if($birthCertificate->father_religion)
                                    <p><strong>Religion:</strong> {{ $birthCertificate->father_religion }}</p>
                                @endif
                                @if($birthCertificate->father_occupation)
                                    <p><strong>Occupation:</strong> {{ $birthCertificate->father_occupation }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Marriage Information --}}
                @if($birthCertificate->parents_marriage_date)
                    <div class="mb-4">
                        <h5 class="text-primary"><i class="fas fa-ring me-2"></i>Parents' Marriage Information</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Marriage Date:</strong> {{ \Carbon\Carbon::parse($birthCertificate->parents_marriage_date)->format('F j, Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                @if($birthCertificate->parents_marriage_place)
                                    <p><strong>Marriage Place:</strong> {{ $birthCertificate->parents_marriage_place }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Birth Attendant Information --}}
                @if($birthCertificate->attendant_name)
                    <div class="mb-4">
                        <h5 class="text-primary"><i class="fas fa-user-md me-2"></i>Birth Attendant Information</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Attendant Name:</strong> {{ $birthCertificate->attendant_name }}</p>
                            </div>
                            <div class="col-md-6">
                                @if($birthCertificate->attendant_type)
                                    <p><strong>Attendant Type:</strong> {{ $birthCertificate->attendant_type }}</p>
                                @endif
                                @if($birthCertificate->attendant_title)
                                    <p><strong>Title:</strong> {{ $birthCertificate->attendant_title }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Registration Information --}}
                @if($birthCertificate->date_registered)
                    <div class="mb-4">
                        <h5 class="text-primary"><i class="fas fa-clipboard-check me-2"></i>Registration Information</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Date Registered:</strong> {{ \Carbon\Carbon::parse($birthCertificate->date_registered)->format('F j, Y') }}</p>
                                @if($birthCertificate->registered_by)
                                    <p><strong>Registered By:</strong> {{ $birthCertificate->registered_by }}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if($birthCertificate->registrar_name)
                                    <p><strong>Registrar Name:</strong> {{ $birthCertificate->registrar_name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Record Information --}}
                <div class="mb-4">
                    <h5 class="text-primary"><i class="fas fa-info-circle me-2"></i>Record Information</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Created:</strong> {{ \Carbon\Carbon::parse($birthCertificate->created_at)->format('F j, Y h:i A') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Last Updated:</strong> {{ \Carbon\Carbon::parse($birthCertificate->updated_at)->format('F j, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
