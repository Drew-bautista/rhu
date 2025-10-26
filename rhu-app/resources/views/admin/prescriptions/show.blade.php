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

                @if($prescriptionItems->isEmpty())
                    <p class="text-muted">No medicines recorded for this prescription.</p>
                @else
                    <div class="table-responsive mb-3">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr class="table-light">
                                    <th>#</th>
                                    <th>Medicine</th>
                                    <th>Dosage</th>
                                    <th>Quantity</th>
                                    <th>Frequency / Duration</th>
                                    <th>Instructions</th>
                                    <th>Current Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prescriptionItems as $index => $item)
                                    <tr class="{{ optional($item->medicine)->current_stock < $item->quantity ? 'table-danger' : '' }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if($item->medicine)
                                                <strong>{{ $item->medicine->medicine_name }}</strong><br>
                                                <small class="text-muted">{{ $item->medicine->generic_name ?? 'N/A' }}</small><br>
                                                <small class="text-info">{{ $item->medicine->strength ?? $item->medicine->dosage_form ?? 'N/A' }}</small>
                                            @else
                                                <span class="text-danger">Medicine record not found</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->dosage }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $item->quantity }} {{ optional($item->medicine)->unit ?? 'units' }}</span>
                                        </td>
                                        <td>{{ $item->frequency }}<br><small class="text-muted">{{ $item->duration }}</small></td>
                                        <td>{{ $item->instructions ?? 'N/A' }}</td>
                                        <td>
                                            @if($item->medicine)
                                                @if($item->medicine->current_stock >= $item->quantity)
                                                    <span class="badge bg-success">{{ $item->medicine->current_stock }} {{ $item->medicine->unit ?? 'units' }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ $item->medicine->current_stock }} {{ $item->medicine->unit ?? 'units' }}</span>
                                                    <br><small class="text-danger">Insufficient Stock</small>
                                                @endif
                                            @else
                                                <span class="badge bg-secondary">N/A</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

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
                            {{ optional($prescription->prescribedBy)->firstname }} {{ optional($prescription->prescribedBy)->lastname }}
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
                        @if($hasSufficientStock)
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
                            @if($insufficientItems->isNotEmpty())
                                <ul class="mb-0 small text-danger">
                                    @foreach($insufficientItems as $item)
                                        <li>
                                            {{ optional($item->medicine)->medicine_name ?? 'Unknown Medicine' }} &mdash;
                                            Needed: {{ $item->quantity }}, Available: {{ optional($item->medicine)->current_stock ?? 0 }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
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
