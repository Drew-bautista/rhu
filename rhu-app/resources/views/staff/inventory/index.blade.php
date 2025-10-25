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
                            <li>{{ $item->medicine_name }} - Only {{ $item->current_stock }} {{ $item->unit }} left (Min: {{ $item->minimum_stock }})</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Expired Items Alert --}}
            @if($expiredItems->count() > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-exclamation-triangle"></i> Expired Medicines!</strong>
                    <p class="mb-0">The following medicines have expired:</p>
                    <ul class="mb-0">
                        @foreach($expiredItems as $item)
                            <li>{{ $item->medicine_name }} - Expired on {{ $item->expiry_date->format('M d, Y') }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Out of Stock Alert --}}
            @if($outOfStockItems->count() > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-times-circle"></i> Out of Stock!</strong>
                    <p class="mb-0">The following medicines are out of stock:</p>
                    <ul class="mb-0">
                        @foreach($outOfStockItems as $item)
                            <li>{{ $item->medicine_name }} - {{ $item->current_stock }} {{ $item->unit }} remaining</li>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $medicines->count() }}</div>
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
                                        {{ $medicines->where('current_stock', '>', 0)->count() }}
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
                                        {{ $outOfStockItems->count() }}
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
                        @forelse($medicines as $medicine)
                            <tr>
                                <td><strong>{{ $medicine->medicine_name }}</strong></td>
                                <td>{{ $medicine->generic_name ?? '-' }}</td>
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
                                            'ointment' => 'Ointment',
                                            'powder' => 'Powder',
                                            'other' => 'Other'
                                        ];
                                    @endphp
                                    {{ $typeLabels[$medicine->dosage_form] ?? $medicine->dosage_form }}
                                </td>
                                <td>{{ $medicine->strength }}</td>
                                <td>
                                    <strong class="{{ $medicine->is_low_stock ? 'text-warning' : ($medicine->current_stock <= 0 ? 'text-danger' : 'text-success') }}">
                                        {{ $medicine->current_stock }}
                                    </strong>
                                </td>
                                <td>{{ $medicine->unit }}</td>
                                <td>
                                    @if($medicine->expiry_date)
                                        @php
                                            $expiryDate = $medicine->expiry_date;
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
                                    @if($medicine->current_stock <= 0)
                                        <span class="badge bg-danger">Out of Stock</span>
                                    @elseif($medicine->is_low_stock)
                                        <span class="badge bg-warning">Low Stock</span>
                                    @elseif($medicine->is_expired)
                                        <span class="badge bg-danger">Expired</span>
                                    @else
                                        <span class="badge bg-success">{{ $medicine->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('staff.inventory.show', $medicine->id) }}" 
                                       class="btn btn-info btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('staff.inventory.edit', $medicine->id) }}" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>

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
