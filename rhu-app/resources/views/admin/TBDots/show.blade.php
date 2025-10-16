@extends('layout.app')

@section('content')
<div class="container my-5">
    <div class="card shadow">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-0">TBDOTS Case Details</h3>
                <div>
                    <a href="{{ route('admin.tbdots.index') }}" class="text-dark" style="font-size: 1.25rem;">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>

            <!-- Patient Information Section -->
            <div class="mb-4">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="text-primary">Patient Details</h5>
                    <div>
                        <a href="{{ route('admin.tbdots.edit', $tbdot->id) }}" class="btn btn-warning btn-sm">Update Data</a>
                    </div>
                </div>

                <hr>
                <p><strong>Patient Name:</strong> {{ $tbdot->patient_name ?? 'N/A' }}</p>
                <p><strong>Date of Birth:</strong> {{ $tbdot->date_of_birth ? \Carbon\Carbon::parse($tbdot->date_of_birth)->format('Y-m-d') : 'N/A' }}</p>
                <p><strong>Age:</strong> {{ $tbdot->age ?? 'N/A' }}</p>
                <p><strong>Sex:</strong> {{ ucfirst($tbdot->sex ?? 'N/A') }}</p>
                <p><strong>Contact Number:</strong> {{ $tbdot->contact_number ?? 'N/A' }}</p>
                <p><strong>Address:</strong> {{ $tbdot->address ?? 'N/A' }}</p>
            </div>

            <!-- TB Case Information Section -->
            <div class="mb-4">
                <h5 class="text-primary">TB Case Information</h5>
                <hr>
                <p><strong>Date of Diagnosis:</strong> {{ $tbdot->date_of_diagnosis ? \Carbon\Carbon::parse($tbdot->date_of_diagnosis)->format('Y-m-d') : 'N/A' }}</p>
                <p><strong>Type of TB:</strong> {{ ucfirst(str_replace('_', ' ', $tbdot->tb_type ?? 'N/A')) }}</p>
                <p><strong>Treatment Category:</strong> {{ ucfirst(str_replace('_', ' ', $tbdot->treatment_category ?? 'N/A')) }}</p>
                <p><strong>Treatment Start Date:</strong> {{ $tbdot->treatment_start_date ? \Carbon\Carbon::parse($tbdot->treatment_start_date)->format('Y-m-d') : 'N/A' }}</p>
                <p><strong>Treatment End Date:</strong> {{ $tbdot->treatment_end_date ? \Carbon\Carbon::parse($tbdot->treatment_end_date)->format('Y-m-d') : 'N/A' }}</p>
                <p><strong>Treatment Status:</strong> {{ ucfirst($tbdot->treatment_status ?? 'N/A') }}</p>
                <p><strong>Remarks:</strong> {{ $tbdot->remarks ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
