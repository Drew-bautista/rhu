@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Vaccine Record Details</h4>
                        <div>
                            <a href="{{ route('admin.vaccines.edit', $vaccine->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.vaccines.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h5 class="text-primary mb-3">Patient Information</h5>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Patient Name:</strong> {{ $vaccine->patient_name }}</p>
                                <p><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($vaccine->date_of_birth)->format('F d, Y') }}</p>
                                <p><strong>Age:</strong> {{ $vaccine->age }} years old</p>
                                <p><strong>Age Group:</strong> 
                                    @if($vaccine->age_group == 'infant')
                                        <span class="badge bg-info">Infant</span>
                                    @elseif($vaccine->age_group == 'child')
                                        <span class="badge bg-primary">Child</span>
                                    @elseif($vaccine->age_group == 'adolescent')
                                        <span class="badge bg-success">Adolescent</span>
                                    @elseif($vaccine->age_group == 'adult')
                                        <span class="badge bg-warning">Adult</span>
                                    @else
                                        <span class="badge bg-secondary">Senior</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Sex:</strong> {{ ucfirst($vaccine->sex) }}</p>
                                <p><strong>Contact Number:</strong> {{ $vaccine->contact_number }}</p>
                                <p><strong>Address:</strong> {{ $vaccine->address }}</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h5 class="text-primary mb-3">Vaccine Information</h5>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Vaccine Type:</strong> {{ $vaccine->vaccine_type }}</p>
                                <p><strong>Dose Number:</strong> {{ $vaccine->dose_number }}</p>
                                <p><strong>Date Administered:</strong> {{ \Carbon\Carbon::parse($vaccine->date_administered)->format('F d, Y') }}</p>
                                <p><strong>Next Dose Date:</strong> 
                                    @if($vaccine->next_dose_date)
                                        {{ \Carbon\Carbon::parse($vaccine->next_dose_date)->format('F d, Y') }}
                                        @php
                                            $daysUntilNext = now()->diffInDays(\Carbon\Carbon::parse($vaccine->next_dose_date), false);
                                        @endphp
                                        @if($daysUntilNext > 0)
                                            <span class="badge bg-info">In {{ $daysUntilNext }} days</span>
                                        @elseif($daysUntilNext == 0)
                                            <span class="badge bg-warning">Today</span>
                                        @else
                                            <span class="badge bg-danger">Overdue by {{ abs($daysUntilNext) }} days</span>
                                        @endif
                                    @else
                                        <span class="text-muted">Not scheduled</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Administered By:</strong> {{ $vaccine->administered_by }}</p>
                                <p><strong>Batch Number:</strong> {{ $vaccine->batch_number ?? 'N/A' }}</p>
                                <p><strong>Expiry Date:</strong> 
                                    @if($vaccine->expiry_date)
                                        {{ \Carbon\Carbon::parse($vaccine->expiry_date)->format('F d, Y') }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                                <p><strong>Adverse Reactions:</strong> {{ $vaccine->adverse_reactions ?? 'None reported' }}</p>
                            </div>
                        </div>

                        @if($vaccine->remarks)
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="text-primary mb-3">Remarks</h5>
                                    <p>{{ $vaccine->remarks }}</p>
                                </div>
                            </div>
                        @endif

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted">
                                    <small>
                                        <strong>Created:</strong> {{ $vaccine->created_at->format('F d, Y h:i A') }}<br>
                                        <strong>Last Updated:</strong> {{ $vaccine->updated_at->format('F d, Y h:i A') }}
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
