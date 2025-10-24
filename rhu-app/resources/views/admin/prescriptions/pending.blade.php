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
                                    <tr class="{{ $prescription->inventory->quantity_in_stock < $prescription->quantity_prescribed ? 'table-danger' : '' }}">
                                        <td>{{ $prescription->created_at->format('M d, Y h:i A') }}</td>
                                        <td>
                                            <strong>{{ $prescription->patient_name }}</strong>
                                            @if($prescription->appointment)
                                                <br><small class="text-muted">{{ $prescription->appointment->contact_number }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $prescription->inventory->medicine_name }}</strong><br>
                                            <small class="text-muted">{{ $prescription->inventory->generic_name }}</small><br>
                                            <small class="text-info">{{ $prescription->inventory->dosage_strength }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $prescription->quantity_prescribed }} {{ $prescription->inventory->unit_of_measure }}</span>
                                        </td>
                                        <td>
                                            @if($prescription->inventory->quantity_in_stock >= $prescription->quantity_prescribed)
                                                <span class="badge bg-success">{{ $prescription->inventory->quantity_in_stock }} {{ $prescription->inventory->unit_of_measure }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $prescription->inventory->quantity_in_stock }} {{ $prescription->inventory->unit_of_measure }}</span>
                                                <br><small class="text-danger">Insufficient Stock!</small>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $prescription->dosage_instructions }}<br>
                                            <small class="text-muted">Duration: {{ $prescription->duration_days }} days</small>
                                            @if($prescription->special_instructions)
                                                <br><small class="text-info">{{ $prescription->special_instructions }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($prescription->prescribedBy)
                                                {{ $prescription->prescribedBy->firstname }} {{ $prescription->prescribedBy->lastname }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.prescriptions.show', $prescription->id) }}" 
                                                class="btn btn-info btn-sm mb-1" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            @if($prescription->inventory->quantity_in_stock >= $prescription->quantity_prescribed)
                                                <form action="{{ route('admin.prescriptions.dispense', $prescription->id) }}" 
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm mb-1" 
                                                        title="Dispense Medicine" onclick="return confirm('Dispense this prescription?')">
                                                        <i class="fas fa-check"></i> Dispense
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-secondary btn-sm mb-1" disabled title="Insufficient Stock">
                                                    <i class="fas fa-exclamation-triangle"></i> No Stock
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
