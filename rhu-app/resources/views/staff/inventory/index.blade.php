@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            {{-- Low Stock Alert --}}
            @if($lowStockItems->count() > 0)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-exclamation-triangle"></i> Low Stock Alert!</strong>
                    <p class="mb-0">The following medicines are running low:</p>
                    <ul class="mb-0">
                        @foreach($lowStockItems as $item)
                            <li>{{ $item->medicine_name }} - Only {{ $item->quantity_in_stock }} {{ $item->unit_of_measure }} left</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6">Medicine Inventory</h1>
                        <a href="{{ route('staff.inventory.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Medicine
                        </a>
                    </div>
                </div>
                {{-- Search bar --}}
                <x-searchBar placeholder="Search medicines..." />
            </div>

            {{-- Statistics Cards --}}
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Medicines</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $inventory->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-pills fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        In Stock</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $inventory->where('quantity_in_stock', '>', 0)->count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Low Stock</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $lowStockItems->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Out of Stock</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $inventory->where('quantity_in_stock', 0)->count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-hover" id="inventoryTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-light">
                            <th>Medicine Name</th>
                            <th>Generic Name</th>
                            <th>Type</th>
                            <th>Dosage</th>
                            <th>Stock</th>
                            <th>Unit</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="inventoryTableBody">
                        @forelse($inventory as $item)
                            <tr>
                                <td><strong>{{ $item->medicine_name }}</strong></td>
                                <td>{{ $item->generic_name ?? '-' }}</td>
                                <td>
                                    @php
                                        $typeLabels = [
                                            'tablet' => 'Tablet',
                                            'capsule' => 'Capsule',
                                            'syrup' => 'Syrup',
                                            'injection' => 'Injection',
                                            'cream' => 'Cream',
                                            'drops' => 'Drops',
                                            'inhaler' => 'Inhaler',
                                            'other' => 'Other'
                                        ];
                                    @endphp
                                    {{ $typeLabels[$item->medicine_type] ?? $item->medicine_type }}
                                </td>
                                <td>{{ $item->dosage_strength }}</td>
                                <td>
                                    <strong>{{ $item->quantity_in_stock }}</strong>
                                </td>
                                <td>{{ $item->unit_of_measure }}</td>
                                <td>
                                    @if($item->expiry_date)
                                        @php
                                            $expiryDate = \Carbon\Carbon::parse($item->expiry_date);
                                            $daysUntilExpiry = now()->diffInDays($expiryDate, false);
                                        @endphp
                                        @if($daysUntilExpiry < 0)
                                            <span class="text-danger">
                                                <i class="fas fa-exclamation-circle"></i> Expired
                                            </span>
                                        @elseif($daysUntilExpiry <= 30)
                                            <span class="text-warning">
                                                {{ $expiryDate->format('M d, Y') }}
                                                <br><small>Expires in {{ $daysUntilExpiry }} days</small>
                                            </span>
                                        @else
                                            {{ $expiryDate->format('M d, Y') }}
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($item->quantity_in_stock == 0)
                                        <span class="badge bg-danger">Out of Stock</span>
                                    @elseif($item->isLowStock())
                                        <span class="badge bg-warning">Low Stock</span>
                                    @else
                                        <span class="badge bg-success">In Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('staff.inventory.show', $item->id) }}" 
                                       class="btn btn-info btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('staff.inventory.edit', $item->id) }}" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-success btn-sm" 
                                            data-bs-toggle="modal" data-bs-target="#prescribeModal{{ $item->id }}"
                                            title="Prescribe" {{ $item->quantity_in_stock == 0 ? 'disabled' : '' }}>
                                        <i class="fas fa-prescription"></i>
                                    </button>
                                </td>
                            </tr>

                            {{-- Prescribe Modal --}}
                            <div class="modal fade" id="prescribeModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('staff.inventory.prescribe') }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">Prescribe {{ $item->medicine_name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="inventory_id" value="{{ $item->id }}">
                                                
                                                <div class="mb-3">
                                                    <label class="form-label">Medicine</label>
                                                    <input type="text" class="form-control" value="{{ $item->medicine_name }} ({{ $item->dosage_strength }})" readonly>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Available Stock</label>
                                                    <input type="text" class="form-control" value="{{ $item->quantity_in_stock }} {{ $item->unit_of_measure }}" readonly>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="appointment_id" class="form-label">Select Appointment <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="appointment_id" required>
                                                        <option value="">-- Select Appointment --</option>
                                                        @php
                                                            $appointments = \App\Models\Appointment::where('status', 'pending')
                                                                ->orderBy('date_of_appointment', 'desc')
                                                                ->get();
                                                        @endphp
                                                        @foreach($appointments as $appointment)
                                                            <option value="{{ $appointment->id }}">
                                                                {{ $appointment->name }} - {{ $appointment->date_of_appointment }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="patient_name" class="form-label">Patient Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="patient_name" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="quantity_prescribed" class="form-label">Quantity to Prescribe <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="quantity_prescribed" 
                                                           min="1" max="{{ $item->quantity_in_stock }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="dosage_instructions" class="form-label">Dosage Instructions <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="dosage_instructions" 
                                                           placeholder="e.g., 1 tablet 3x a day after meals" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="duration_days" class="form-label">Duration (Days) <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="duration_days" min="1" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="special_instructions" class="form-label">Special Instructions</label>
                                                    <textarea class="form-control" name="special_instructions" rows="2"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Prescribe Medicine</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No medicines in inventory.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Client-side search filtering for Inventory
    $(document).ready(function () {
        const $input = $('#searchInput');
        const $tbody = $('#inventoryTableBody');

        if ($input.length && $tbody.length) {
            $input.on('input', function () {
                const q = $(this).val().toLowerCase().trim();
                $tbody.find('tr').each(function () {
                    const text = $(this).text().toLowerCase();
                    $(this).toggle(text.indexOf(q) !== -1);
                });
            });
        }
    });
</script>
