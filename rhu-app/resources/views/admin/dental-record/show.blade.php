@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3 class="mb-0">Dental Record</h3>
                    <div>
                        <a href="{{ route('admin.dental-record.index') }}" class="text-dark" style="font-size: 1.25rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <!-- Patient Information Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-primary">Patient Details</h5>
                        <div>
                            <a href="{{ route('admin.dental-record.edit', $dentalRecords->id) }}" class="btn btn-warning btn-sm">Update Data</a>
                        </div>
                    </div>

                    <hr>
                    <p>
                        <strong>Name:</strong> {{ $dentalRecords->appointments ? $dentalRecords->appointments->name : 'N/A' }}
                    </p>
                    <p>
                        <strong>Age:</strong> {{ $dentalRecords->appointments ? $dentalRecords->appointments->age : 'N/A' }}
                    </p>
                    <p>
                        <strong>Contact:</strong> {{ $dentalRecords->appointments ? $dentalRecords->appointments->contact_number : 'N/A' }}
                    </p>
                    <p>
                        <strong>Address:</strong> {{ $dentalRecords->appointments ? $dentalRecords->appointments->address : 'N/A' }}
                    </p>
                    {{-- <p>
                        <strong>Service:</strong> {{ $dentalRecords->appointments->service }}
                    </p> --}}
                    <p>
                        <strong>Appointment Date & Time:</strong>
                        @if($dentalRecords->appointments)
                            {{ \Carbon\Carbon::parse($dentalRecords->appointments->date_of_appointment)->format('F j, Y') }} /
                            {{ \Carbon\Carbon::parse($dentalRecords->appointments->time)->format('h:i A') }}
                        @else
                            N/A
                        @endif
                    </p>
                    <p><strong>Date of Birth:</strong>
                        @if($dentalRecords->appointments && $dentalRecords->appointments->date_of_birth)
                            {{ \Carbon\Carbon::parse($dentalRecords->appointments->date_of_birth)->format('Y-m-d') }}
                        @else
                            N/A
                        @endif
                    </p>
                    {{-- <p><strong>Gender:</strong> {{ ucfirst($dentalRecords->sex) }}</p> --}}
                    <p>
                        <strong>Emergency Contact:</strong> {{ $dentalRecords->appointments ? $dentalRecords->appointments->emergency_contact : 'N/A' }}
                    </p>

                </div>
                <!-- Health Assessment Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-primary">Dental Details</h5>
                        <a href="{{ route('admin.dental-record.edit', $dentalRecords->id) }}"
                            class="btn btn-warning btn-sm">Update Data</a>
                    </div>

                    <hr>
                    <p>
                        <strong>Services Performed:</strong> {{ $dentalRecords->services ?? 'N/A' }}
                    </p>
                    <p>
                        <strong>Tooth/Area Involved:</strong> {{ $dentalRecords->tooth_area ?? 'N/A' }}
                    </p>
                    <p>
                        <strong>Findings:</strong> {{ $dentalRecords->findings ?? 'N/A' }}
                    </p>
                    <p>
                        <strong>Prescription:</strong> {{ $dentalRecords->prescription ?? 'N/A' }}
                    </p>

                </div>



            </div>
        </div>
    </div>
@endsection
