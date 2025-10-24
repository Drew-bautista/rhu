@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6">CBC Results</h1>
                        <a href="{{ route('staff.cbc-results.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add CBC Result
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <strong>Total:</strong>
                            </div>
                            <div class="h5 ms-1 mb-1.5 font-weight-bold text-gray-800" id="appointmentCount">
                            </div>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search CBC..." />
                    </div>
                </div>

                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover" id="cbcResultsTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-light">
                                    <th>Name</th>
                                    {{-- <th>Test Date</th> --}}
                                    <th>Hemoglobin</th>
                                    <th>Hematocrit</th>
                                    <th>RBC</th>
                                    <th>WBC</th>
                                    <th>Platelet</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="cbcResultsTableBody">
                                @forelse($cbcResults as $cbcResult)
                                    <tr>
                                        <td>
                                            {{ $cbcResult->appointments->name }}
                                        </td>
                                        {{-- <td>{{ \Carbon\Carbon::parse($cbcResult->appointments->date_of_appointment)->format('Y/m/d') }}
                                        </td> --}}
                                        <td>{{ $cbcResult->hemoglobin }}</td>
                                        <td>
                                            {{ $cbcResult->hematocrit }}
                                        </td>
                                        <td>{{ $cbcResult->rbc_count }}</td>
                                        <td>
                                            {{ $cbcResult->wbc_count }}
                                        </td>
                                        <td>{{ $cbcResult->platelet_count }}</td>
                                        <td>
                                            <a href="{{ route('staff.cbc-results.show', $cbcResult->id) }}" 
                                               class="btn btn-info btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('staff.cbc-results.edit', $cbcResult->id) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        {{-- <td>
                                            {{ \Carbon\Carbon::parse($cbcResult->appointment_date)->format('Y/m/d') }} /
                                            {{ \Carbon\Carbon::parse($cbcResult->time)->format('h:i A') }}
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No CBC results found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Client-side filter for CBC Results
    $(document).ready(function () {
        const $input = $('#searchInput');
        const $tbody = $('#cbcResultsTableBody');
        const $count = $('#appointmentCount');

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
