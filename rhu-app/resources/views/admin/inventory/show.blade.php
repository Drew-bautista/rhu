@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Medicine Details: {{ $medicine->medicine_name }}</h4>
                        <div>
                            <a href="{{ route('admin.inventory.edit', $medicine->id) }}" class="btn btn-warning btn-sm">
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
                                        <th width="40%">Generic Name:</th>
                                        <td>{{ $medicine->generic_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Brand Name:</th>
                                        <td>{{ $medicine->brand_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dosage Form:</th>
                                        <td>{{ $medicine->dosage_form ? ucfirst($medicine->dosage_form) : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Strength:</th>
                                        <td>{{ $medicine->strength ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Classification:</th>
                                        <td>{{ $medicine->classification ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Category:</th>
                                        <td>{{ $medicine->category ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <h5 class="text-primary mb-3">Stock Information</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="40%">Current Stock:</th>
                                        <td>
                                            <strong class="{{ $medicine->current_stock <= 0 ? 'text-danger' : ($medicine->is_low_stock ? 'text-warning' : 'text-success') }}">
                                                {{ $medicine->current_stock }} {{ $medicine->unit ?? 'units' }}
                                            </strong>
                                            @if($medicine->current_stock <= 0)
                                                <span class="badge bg-danger ms-2">Out of Stock</span>
                                            @elseif($medicine->is_low_stock)
                                                <span class="badge bg-warning ms-2">Low Stock</span>
                                            @else
                                                <span class="badge bg-success ms-2">In Stock</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Minimum Stock:</th>
                                        <td>{{ $medicine->minimum_stock }} {{ $medicine->unit ?? 'units' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Maximum Stock:</th>
                                        <td>{{ $medicine->maximum_stock ?? 'N/A' }} {{ $medicine->unit ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Unit Price:</th>
                                        <td>{{ $medicine->unit_price ? '₱' . number_format($medicine->unit_price, 2) : 'N/A' }}</td>
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
                                        <td>{{ $medicine->batch_number ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Expiry Date:</th>
                                        <td>
                                            @if($medicine->expiry_date)
                                                @php
                                                    $expiryDate = \Carbon\Carbon::parse($medicine->expiry_date);
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
                                        <th>Manufacturer:</th>
                                        <td>{{ $medicine->manufacturer ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <td>
                                            <span class="badge {{ $medicine->status === 'Active' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $medicine->status ?? 'N/A' }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                @if($medicine->description)
                                    <h5 class="text-primary mb-3">Notes</h5>
                                    <p>{{ $medicine->description }}</p>
                                @elseif($medicine->notes)
                                    <h5 class="text-primary mb-3">Notes</h5>
                                    <p>{{ $medicine->notes }}</p>
                                @endif
                            </div>
                        </div>

                        <hr>

                        {{-- Recent Prescriptions --}}
                        <h5 class="text-primary mb-3">Recent Prescriptions</h5>
                        @if($prescriptionItems->count() > 0)
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
                                        @foreach($prescriptionItems->take(10) as $prescriptionItem)
                                            <tr>
                                                <td>{{ $prescriptionItem->created_at->format('M d, Y') }}</td>
                                                <td>{{ $prescriptionItem->prescription->patient_name ?? 'N/A' }}</td>
                                                <td>{{ $prescriptionItem->quantity }} {{ $medicine->unit ?? 'units' }}</td>
                                                <td>{{ $prescriptionItem->dosage }} - {{ $prescriptionItem->frequency }} ({{ $prescriptionItem->duration }})</td>
                                                <td>{{ optional($prescriptionItem->prescription->prescribedBy)->firstname }} {{ optional($prescriptionItem->prescription->prescribedBy)->lastname }}</td>
                                                <td>
                                                    @php
                                                        $status = strtolower($prescriptionItem->prescription->status ?? 'pending');
                                                    @endphp
                                                    @if($status === 'dispensed')
                                                        <span class="badge bg-success">Dispensed</span>
                                                    @elseif($status === 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ ucfirst($status) }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if($prescriptionItems->count() > 10)
                                    <p class="text-muted">Showing 10 most recent prescriptions out of {{ $prescriptionItems->count() }} total</p>
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
                                        <strong>Created:</strong> {{ $medicine->created_at?->format('F d, Y h:i A') ?? 'N/A' }}<br>
                                        <strong>Last Updated:</strong> {{ $medicine->updated_at?->format('F d, Y h:i A') ?? 'N/A' }}
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
