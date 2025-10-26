@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Medicine Details: {{ $medicine->medicine_name }}</h2>
                        <div>
                            <a href="{{ route('staff.inventory.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-arrow-left"></i> Back to Inventory
                            </a>
                            <a href="{{ route('staff.inventory.edit', $medicine->id) }}" class="btn btn-primary">
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
                                            <td>{{ $medicine->medicine_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Generic Name:</strong></td>
                                            <td>{{ $medicine->generic_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Brand Name:</strong></td>
                                            <td>{{ $medicine->brand_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Type:</strong></td>
                                            <td>
                                                <span class="badge bg-info">{{ $medicine->dosage_form ? ucfirst($medicine->dosage_form) : 'N/A' }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Dosage Strength:</strong></td>
                                            <td>{{ $medicine->strength ?? 'N/A' }}</td>
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
                                                <span class="badge {{ $medicine->current_stock <= 0 ? 'bg-danger' : ($medicine->is_low_stock ? 'bg-warning' : 'bg-success') }}">
                                                    {{ $medicine->current_stock }} {{ $medicine->unit ?? 'units' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Reorder Level:</strong></td>
                                            <td>{{ $medicine->minimum_stock }} {{ $medicine->unit ?? 'units' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Expiry Date:</strong></td>
                                            <td>
                                                @if($medicine->expiry_date)
                                                    @php
                                                        $expiryDate = \Carbon\Carbon::parse($medicine->expiry_date);
                                                        $daysUntilExpiry = now()->diffInDays($expiryDate, false);
                                                    @endphp
                                                    {{ $expiryDate->format('M d, Y') }}
                                                    @if($daysUntilExpiry < 0)
                                                        <span class="badge bg-danger ms-2">Expired {{ abs($daysUntilExpiry) }} days ago</span>
                                                    @elseif($daysUntilExpiry == 0)
                                                        <span class="badge bg-danger ms-2">Expires Today</span>
                                                    @elseif($daysUntilExpiry <= 30)
                                                        <span class="badge bg-warning ms-2">Expires in {{ $daysUntilExpiry }} days</span>
                                                    @endif
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Batch Number:</strong></td>
                                            <td>{{ $medicine->batch_number ?? 'N/A' }}</td>
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
                                            <p><strong>Manufacturer:</strong> {{ $medicine->manufacturer ?? 'N/A' }}</p>
                                            <p><strong>Classification:</strong> {{ $medicine->classification ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Notes:</strong></p>
                                            <p class="text-muted">{{ $medicine->notes ?? $medicine->description ?? 'No additional notes' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($prescriptionItems->count() > 0)
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
                                            @foreach($prescriptionItems as $item)
                                                <tr>
                                                    <td>{{ $item->created_at->format('M d, Y') }}</td>
                                                    <td>{{ optional($item->prescription)->patient_name ?? 'N/A' }}</td>
                                                    <td>{{ $item->quantity }} {{ $medicine->unit ?? 'units' }}</td>
                                                    <td>{{ $item->dosage ?? 'N/A' }} {{ $item->frequency ? '- ' . $item->frequency : '' }}</td>
                                                    <td>{{ $item->duration ?? 'N/A' }}</td>
                                                    <td>
                                                        {{ optional(optional($item->prescription)->prescribedBy)->firstname }}
                                                        {{ optional(optional($item->prescription)->prescribedBy)->lastname }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $status = strtolower(optional($item->prescription)->status ?? 'pending');
                                                        @endphp
                                                        <span class="badge bg-{{ $status === 'dispensed' ? 'success' : ($status === 'pending' ? 'warning' : 'secondary') }}">
                                                            {{ ucfirst($status) }}
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
