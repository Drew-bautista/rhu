@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6">Pending Prescriptions</h1>
                        <div>
                            <a href="{{ route('admin.prescriptions.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> All Prescriptions
                            </a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <div class="d-flex align-items-center">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                <strong>Pending:</strong>
                            </div>
                            <div class="h5 ms-1 mb-1.5 font-weight-bold text-gray-800">
                                {{ $prescriptions->total() }}
                            </div>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search pending prescriptions..." />
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover" id="prescriptionTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-light">
                                    <th>Date</th>
                                    <th>Patient Name</th>
                                    <th>Medicine</th>
                                    <th>Quantity</th>
                                    <th>Available Stock</th>
                                    <th>Dosage Instructions</th>
                                    <th>Prescribed By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="prescriptionTableBody">
                                @forelse($prescriptions as $prescription)
                                    @foreach($prescription->prescriptionItems as $item)
                                        @php
                                            $medicine = $item->medicine;
                                        @endphp
                                        <tr class="{{ ($medicine && $medicine->current_stock < $item->quantity) ? 'table-danger' : '' }}">
                                            <td>{{ $prescription->created_at->format('M d, Y h:i A') }}</td>
                                            <td>
                                                <strong>{{ $prescription->patient_name }}</strong>
                                                @if($prescription->appointment)
                                                    <br><small class="text-muted">{{ $prescription->appointment->contact_number ?? 'N/A' }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($medicine)
                                                    <strong>{{ $medicine->medicine_name }}</strong><br>
                                                    <small class="text-muted">{{ $medicine->generic_name ?? 'N/A' }}</small><br>
                                                    <small class="text-info">{{ $medicine->strength ?? $medicine->dosage_form ?? 'N/A' }}</small>
                                                @else
                                                    <span class="text-danger">Medicine record missing</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ $item->quantity }} {{ $medicine->unit ?? 'units' }}</span>
                                            </td>
                                            <td>
                                                @if($medicine && $medicine->current_stock >= $item->quantity)
                                                    <span class="badge bg-success">{{ $medicine->current_stock }} {{ $medicine->unit ?? 'units' }}</span>
                                                @elseif($medicine)
                                                    <span class="badge bg-danger">{{ $medicine->current_stock }} {{ $medicine->unit ?? 'units' }}</span>
                                                    <br><small class="text-danger">Insufficient Stock!</small>
                                                @else
                                                    <span class="badge bg-secondary">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->dosage }} - {{ $item->frequency }}<br>
                                                <small class="text-muted">Duration: {{ $item->duration }}</small>
                                                @if($item->instructions)
                                                    <br><small class="text-info">{{ $item->instructions }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $prescription->doctor_name ?? 'N/A' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.prescriptions.show', $prescription->id) }}" 
                                                    class="btn btn-info btn-sm mb-1" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                @if($medicine && $medicine->current_stock >= $item->quantity)
                                                    <form action="{{ route('admin.prescriptions.dispense', $prescription->id) }}" 
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success btn-sm mb-1" 
                                                            title="Dispense Medicine" onclick="return confirm('Dispense this prescription?')">
                                                            <i class="fas fa-check"></i> Dispense
                                                        </button>
                                                    </form>
                                                @elseif($medicine)
                                                    <button class="btn btn-secondary btn-sm mb-1" disabled title="Insufficient Stock">
                                                        <i class="fas fa-exclamation-triangle"></i> No Stock
                                                    </button>
                                                @else
                                                    <button class="btn btn-secondary btn-sm mb-1" disabled title="Medicine Missing">
                                                        <i class="fas fa-exclamation-triangle"></i> Medicine Missing
                                                    </button>
                                                @endif
                                                
                                                <form action="{{ route('admin.prescriptions.cancel', $prescription->id) }}" 
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm mb-1" 
                                                        title="Cancel Prescription" onclick="return confirm('Cancel this prescription?')">
                                                        <i class="fas fa-times"></i> Cancel
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <div class="py-4">
                                                <i class="fas fa-prescription-bottle fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No Pending Prescriptions</h5>
                                                <p class="text-muted">All prescriptions have been processed.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {{ $prescriptions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Client-side search functionality
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            let query = $(this).val().toLowerCase().trim();
            let visibleRows = 0;

            $('#prescriptionTableBody tr').each(function() {
                let row = $(this);
                let text = row.text().toLowerCase();
                
                if (text.includes(query)) {
                    row.show();
                    visibleRows++;
                } else {
                    row.hide();
                }
            });
        });
    });
</script>
