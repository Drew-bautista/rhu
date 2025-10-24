@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6">Prescription Management</h1>
                        <div>
                            <a href="{{ route('admin.prescriptions.pending') }}" class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-clock"></i> Pending Prescriptions
                            </a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <div class="d-flex align-items-center">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <strong>Total:</strong>
                            </div>
                            <div class="h5 ms-1 mb-1.5 font-weight-bold text-gray-800">
                                {{ $prescriptions->total() }}
                            </div>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search prescriptions..." />
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
                                    <th>Dosage</th>
                                    <th>Prescribed By</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="prescriptionTableBody">
                                @forelse($prescriptions as $prescription)
                                    <tr>
                                        <td>{{ $prescription->created_at->format('M d, Y') }}</td>
                                        <td>{{ $prescription->patient_name }}</td>
                                        <td>
                                            <strong>{{ $prescription->inventory->medicine_name }}</strong><br>
                                            <small class="text-muted">{{ $prescription->inventory->generic_name }}</small>
                                        </td>
                                        <td>{{ $prescription->quantity_prescribed }} {{ $prescription->inventory->unit_of_measure }}</td>
                                        <td>{{ $prescription->dosage_instructions }}</td>
                                        <td>
                                            @if($prescription->prescribedBy)
                                                {{ $prescription->prescribedBy->firstname }} {{ $prescription->prescribedBy->lastname }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($prescription->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($prescription->status == 'dispensed')
                                                <span class="badge bg-success">Dispensed</span>
                                            @elseif($prescription->status == 'cancelled')
                                                <span class="badge bg-danger">Cancelled</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($prescription->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.prescriptions.show', $prescription->id) }}" 
                                                class="btn btn-info btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            @if($prescription->status == 'pending')
                                                <form action="{{ route('admin.prescriptions.dispense', $prescription->id) }}" 
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm" 
                                                        title="Dispense" onclick="return confirm('Dispense this prescription?')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('admin.prescriptions.cancel', $prescription->id) }}" 
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                        title="Cancel" onclick="return confirm('Cancel this prescription?')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No prescriptions found.</td>
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
