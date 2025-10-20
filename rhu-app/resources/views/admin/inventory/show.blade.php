@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Medicine Details: {{ $inventory->medicine_name }}</h4>
                        <div>
                            <a href="{{ route('admin.inventory.edit', $inventory->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.inventory.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-primary mb-3">Medicine Information</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="40%">Medicine Name:</th>
                                        <td>{{ $inventory->medicine_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Generic Name:</th>
                                        <td>{{ $inventory->generic_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Brand Name:</th>
                                        <td>{{ $inventory->brand_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Type:</th>
                                        <td>{{ ucfirst($inventory->medicine_type) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dosage Strength:</th>
                                        <td>{{ $inventory->dosage_strength }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <h5 class="text-primary mb-3">Stock Information</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="40%">Current Stock:</th>
                                        <td>
                                            <strong class="{{ $inventory->quantity_in_stock == 0 ? 'text-danger' : ($inventory->isLowStock() ? 'text-warning' : 'text-success') }}">
                                                {{ $inventory->quantity_in_stock }} {{ $inventory->unit_of_measure }}
                                            </strong>
                                            @if($inventory->quantity_in_stock == 0)
                                                <span class="badge bg-danger ms-2">Out of Stock</span>
                                            @elseif($inventory->isLowStock())
                                                <span class="badge bg-warning ms-2">Low Stock</span>
                                            @else
                                                <span class="badge bg-success ms-2">In Stock</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Reorder Level:</th>
                                        <td>{{ $inventory->reorder_level }} {{ $inventory->unit_of_measure }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-primary mb-3">Additional Details</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="40%">Batch Number:</th>
                                        <td>{{ $inventory->batch_number ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Expiry Date:</th>
                                        <td>
                                            @if($inventory->expiry_date)
                                                @php
                                                    $expiryDate = \Carbon\Carbon::parse($inventory->expiry_date);
                                                    $daysUntilExpiry = now()->diffInDays($expiryDate, false);
                                                @endphp
                                                {{ $expiryDate->format('F d, Y') }}
                                                @if($daysUntilExpiry < 0)
                                                    <span class="badge bg-danger ms-2">Expired {{ abs($daysUntilExpiry) }} days ago</span>
                                                @elseif($daysUntilExpiry == 0)
                                                    <span class="badge bg-danger ms-2">Expires Today</span>
                                                @elseif($daysUntilExpiry <= 30)
                                                    <span class="badge bg-warning ms-2">Expires in {{ $daysUntilExpiry }} days</span>
                                                @else
                                                    <span class="badge bg-success ms-2">Valid</span>
                                                @endif
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Supplier:</th>
                                        <td>{{ $inventory->supplier ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Storage Location:</th>
                                        <td>{{ $inventory->storage_location ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                @if($inventory->notes)
                                    <h5 class="text-primary mb-3">Notes</h5>
                                    <p>{{ $inventory->notes }}</p>
                                @endif
                            </div>
                        </div>

                        <hr>

                        {{-- Recent Prescriptions --}}
                        <h5 class="text-primary mb-3">Recent Prescriptions</h5>
                        @if($prescriptions->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="table-light">
                                            <th>Date</th>
                                            <th>Patient</th>
                                            <th>Quantity</th>
                                            <th>Dosage Instructions</th>
                                            <th>Prescribed By</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($prescriptions->take(10) as $prescription)
                                            <tr>
                                                <td>{{ $prescription->created_at->format('M d, Y') }}</td>
                                                <td>{{ $prescription->patient_name }}</td>
                                                <td>{{ $prescription->quantity_prescribed }}</td>
                                                <td>{{ $prescription->dosage_instructions }}</td>
                                                <td>{{ $prescription->prescribedBy->firstname }} {{ $prescription->prescribedBy->lastname }}</td>
                                                <td>
                                                    @if($prescription->status == 'dispensed')
                                                        <span class="badge bg-success">Dispensed</span>
                                                    @elseif($prescription->status == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ ucfirst($prescription->status) }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if($prescriptions->count() > 10)
                                    <p class="text-muted">Showing 10 most recent prescriptions out of {{ $prescriptions->count() }} total</p>
                                @endif
                            </div>
                        @else
                            <p class="text-muted">No prescriptions yet for this medicine.</p>
                        @endif

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted">
                                    <small>
                                        <strong>Created:</strong> {{ $inventory->created_at->format('F d, Y h:i A') }}<br>
                                        <strong>Last Updated:</strong> {{ $inventory->updated_at->format('F d, Y h:i A') }}
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
