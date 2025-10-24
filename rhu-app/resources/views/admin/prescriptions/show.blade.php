@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3 class="mb-0"><i class="fas fa-prescription-bottle me-2"></i>Prescription Details</h3>
                    <div>
                        <a href="{{ route('admin.prescriptions.index') }}" class="text-dark" style="font-size: 1.25rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                {{-- Status Badge --}}
                <div class="mb-4">
                    @if($prescription->status == 'pending')
                        <span class="badge bg-warning fs-6">Pending</span>
                    @elseif($prescription->status == 'dispensed')
                        <span class="badge bg-success fs-6">Dispensed</span>
                    @elseif($prescription->status == 'cancelled')
                        <span class="badge bg-danger fs-6">Cancelled</span>
                    @else
                        <span class="badge bg-secondary fs-6">{{ ucfirst($prescription->status) }}</span>
                    @endif
                </div>

                {{-- Patient Information --}}
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="text-primary">Patient Information</h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Patient Name:</strong> {{ $prescription->patient_name }}</p>
                        @if($prescription->appointment)
                            <p><strong>Contact Number:</strong> {{ $prescription->appointment->contact_number ?? 'N/A' }}</p>
                            <p><strong>Appointment Date:</strong> {{ $prescription->appointment->appointment_date ? \Carbon\Carbon::parse($prescription->appointment->appointment_date)->format('F j, Y') : 'N/A' }}</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <p><strong>Prescription Date:</strong> {{ $prescription->created_at->format('F j, Y h:i A') }}</p>
                    </div>
                </div>

                {{-- Medicine Information --}}
                <h5 class="text-primary mt-4">Medicine Information</h5>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Medicine Name:</strong> {{ $prescription->inventory->medicine_name }}</p>
                        <p><strong>Generic Name:</strong> {{ $prescription->inventory->generic_name ?? 'N/A' }}</p>
                        <p><strong>Dosage Strength:</strong> {{ $prescription->inventory->dosage_strength ?? 'N/A' }}</p>
                        <p><strong>Unit of Measure:</strong> {{ $prescription->inventory->unit_of_measure }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Quantity Prescribed:</strong> {{ $prescription->quantity_prescribed }} {{ $prescription->inventory->unit_of_measure }}</p>
                        <p><strong>Available Stock:</strong> 
                            @if($prescription->inventory->quantity_in_stock >= $prescription->quantity_prescribed)
                                <span class="text-success">{{ $prescription->inventory->quantity_in_stock }} {{ $prescription->inventory->unit_of_measure }}</span>
                            @else
                                <span class="text-danger">{{ $prescription->inventory->quantity_in_stock }} {{ $prescription->inventory->unit_of_measure }} (Insufficient)</span>
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Prescription Details --}}
                <h5 class="text-primary mt-4">Prescription Details</h5>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Dosage Instructions:</strong> {{ $prescription->dosage_instructions }}</p>
                        <p><strong>Duration:</strong> {{ $prescription->duration_days ?? 'N/A' }} days</p>
                        @if($prescription->special_instructions)
                            <p><strong>Special Instructions:</strong> {{ $prescription->special_instructions }}</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <p><strong>Prescribed By:</strong> 
                            @if($prescription->prescribedBy)
                                {{ $prescription->prescribedBy->firstname }} {{ $prescription->prescribedBy->lastname }}
                            @else
                                N/A
                            @endif
                        </p>
                        @if($prescription->status == 'dispensed')
                            <p><strong>Dispensed At:</strong> {{ $prescription->dispensed_at ? \Carbon\Carbon::parse($prescription->dispensed_at)->format('F j, Y h:i A') : 'N/A' }}</p>
                            <p><strong>Dispensed By:</strong> 
                                @if($prescription->dispensedBy)
                                    {{ $prescription->dispensedBy->firstname }} {{ $prescription->dispensedBy->lastname }}
                                @else
                                    N/A
                                @endif
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Action Buttons --}}
                @if($prescription->status == 'pending')
                    <div class="mt-4 d-flex gap-2">
                        @if($prescription->inventory->quantity_in_stock >= $prescription->quantity_prescribed)
                            <form action="{{ route('admin.prescriptions.dispense', $prescription->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success" onclick="return confirm('Dispense this prescription?')">
                                    <i class="fas fa-check"></i> Dispense Medicine
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary" disabled title="Insufficient Stock">
                                <i class="fas fa-exclamation-triangle"></i> Insufficient Stock
                            </button>
                        @endif
                        
                        <form action="{{ route('admin.prescriptions.cancel', $prescription->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Cancel this prescription?')">
                                <i class="fas fa-times"></i> Cancel Prescription
                            </button>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
