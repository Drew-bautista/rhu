@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Medicine Details</h2>
                        <div>
                            <a href="{{ route('staff.inventory.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-arrow-left"></i> Back to Inventory
                            </a>
                            <a href="{{ route('staff.inventory.edit', $inventory->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Basic Information</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Medicine Name:</strong></td>
                                            <td>{{ $inventory->medicine_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Generic Name:</strong></td>
                                            <td>{{ $inventory->generic_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Brand Name:</strong></td>
                                            <td>{{ $inventory->brand_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Type:</strong></td>
                                            <td>
                                                <span class="badge bg-info">{{ ucfirst($inventory->medicine_type) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Dosage Strength:</strong></td>
                                            <td>{{ $inventory->dosage_strength }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Stock Information</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Current Stock:</strong></td>
                                            <td>
                                                <span class="badge {{ $inventory->isLowStock() ? 'bg-danger' : 'bg-success' }}">
                                                    {{ $inventory->quantity_in_stock }} {{ $inventory->unit_of_measure }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Reorder Level:</strong></td>
                                            <td>{{ $inventory->reorder_level }} {{ $inventory->unit_of_measure }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Expiry Date:</strong></td>
                                            <td>
                                                @if($inventory->expiry_date)
                                                    {{ $inventory->expiry_date->format('M d, Y') }}
                                                    @if($inventory->expiry_date->isPast())
                                                        <span class="badge bg-danger ms-2">Expired</span>
                                                    @elseif($inventory->expiry_date->diffInDays() <= 30)
                                                        <span class="badge bg-warning ms-2">Expiring Soon</span>
                                                    @endif
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Batch Number:</strong></td>
                                            <td>{{ $inventory->batch_number ?? 'N/A' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Additional Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Supplier:</strong> {{ $inventory->supplier ?? 'N/A' }}</p>
                                            <p><strong>Storage Location:</strong> {{ $inventory->storage_location ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Notes:</strong></p>
                                            <p class="text-muted">{{ $inventory->notes ?? 'No additional notes' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($prescriptions->count() > 0)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Prescription History</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Patient</th>
                                                <th>Quantity</th>
                                                <th>Dosage Instructions</th>
                                                <th>Duration</th>
                                                <th>Prescribed By</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($prescriptions as $prescription)
                                                <tr>
                                                    <td>{{ $prescription->created_at->format('M d, Y') }}</td>
                                                    <td>{{ $prescription->patient_name }}</td>
                                                    <td>{{ $prescription->quantity_prescribed }} {{ $inventory->unit_of_measure }}</td>
                                                    <td>{{ $prescription->dosage_instructions }}</td>
                                                    <td>{{ $prescription->duration_days }} days</td>
                                                    <td>
                                                        @if($prescription->prescribedBy)
                                                            {{ $prescription->prescribedBy->name }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-{{ $prescription->status == 'dispensed' ? 'success' : 'warning' }}">
                                                            {{ ucfirst($prescription->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-prescription-bottle fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No Prescription History</h5>
                                <p class="text-muted">This medicine has not been prescribed yet.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
