@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6">Birth Certificates</h1>
                        <a href="{{ route('staff.birth-certificates.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Birth Certificate
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <div class="d-flex align-items-center">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <strong>Total:</strong>
                            </div>
                            <div class="h5 ms-1 mb-1.5 font-weight-bold text-gray-800" id="birthCertificateCount">
                                {{ $birthCertificates->total() }}
                            </div>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search birth certificates..." />
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

                @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover" id="birthCertificatesTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-light">
                                    <th>Registry No.</th>
                                    <th>Child Name</th>
                                    <th>Date of Birth</th>
                                    <th>Place of Birth</th>
                                    <th>Mother Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="birthCertificatesTableBody">
                                @forelse($birthCertificates as $certificate)
                                    <tr>
                                        <td>
                                            @if($certificate->registry_number)
                                                <span class="badge bg-success">{{ $certificate->registry_number }}</span>
                                            @else
                                                <span class="text-muted">Not Assigned</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $certificate->child_first_name }} 
                                            @if($certificate->child_middle_name){{ $certificate->child_middle_name }} @endif
                                            {{ $certificate->child_last_name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ ucfirst($certificate->child_sex) }}</small>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($certificate->date_of_birth)->format('M d, Y') }}</td>
                                        <td>{{ $certificate->place_of_birth }}</td>
                                        <td>
                                            {{ $certificate->mother_first_name }} 
                                            @if($certificate->mother_middle_name){{ $certificate->mother_middle_name }} @endif
                                            {{ $certificate->mother_last_name }}
                                        </td>
                                        <td>
                                            @if($certificate->status == 'Draft')
                                                <span class="badge bg-secondary">Draft</span>
                                            @elseif($certificate->status == 'Registered')
                                                <span class="badge bg-primary">Registered</span>
                                            @elseif($certificate->status == 'Issued')
                                                <span class="badge bg-success">Issued</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('staff.birth-certificates.show', $certificate->id) }}" 
                                                class="btn btn-info btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('staff.birth-certificates.edit', $certificate->id) }}" 
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="py-4">
                                                <i class="fas fa-certificate fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No Birth Certificates Found</h5>
                                                <p class="text-muted">Start by creating a new birth certificate.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        @if($birthCertificates->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $birthCertificates->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Client-side filter for Birth Certificates
    $(document).ready(function () {
        const $input = $('#searchInput');
        const $tbody = $('#birthCertificatesTableBody');
        const $count = $('#birthCertificateCount');

        if ($input.length && $tbody.length) {
            $input.on('input', function () {
                const q = $(this).val().toLowerCase().trim();
                let visibleCount = 0;
                
                $tbody.find('tr').each(function () {
                    const text = $(this).text().toLowerCase();
                    const isVisible = text.indexOf(q) !== -1;
                    $(this).toggle(isVisible);
                    
                    if (isVisible && !$(this).find('td[colspan]').length) {
                        visibleCount++;
                    }
                });
                
                // Update the count
                $count.text(visibleCount);
            });
        }
        
        // Initialize count
        const initialCount = $tbody.find('tr').not(':has(td[colspan])').length;
        $count.text(initialCount);
    });
</script>
