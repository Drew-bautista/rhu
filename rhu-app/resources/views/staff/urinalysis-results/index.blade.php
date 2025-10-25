@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6">Urinalysis Results</h1>
                        <a href="{{ route('staff.urinalysis-results.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Urinalysis Result
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <div class="d-flex align-items-center">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <strong>Total:</strong>
                            </div>
                            <div class="h5 ms-1 mb-1.5 font-weight-bold text-gray-800" id="urinalysisCount">
                                {{ $urinalysisResults->count() }}
                            </div>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search urinalysis..." />
                    </div>
                </div>

                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover" id="urinalysisTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-light">
                                    <th>Name</th>
                                    {{-- <th>Test Date</th> --}}
                                    <th>Color</th>
                                    <th>Transparency</th>
                                    <th>Specific Gravity</th>
                                    <th>pH</th>
                                    <th>Remarks</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="urinalysisTableBody">
                                @forelse($urinalysisResults as $result)
                                    <tr>
                                        <td>{{ $result->appointments->name ?? 'N/A' }}</td>
                                        {{-- <td>{{ \Carbon\Carbon::parse($result->appointments->date_of_appointment)->format('Y/m/d') }}
                                        </td> --}}
                                        <td>{{ $result->color ?? '-' }}</td>
                                        <td>{{ $result->transparency ?? '-' }}</td>
                                        <td>{{ $result->specific_gravity ?? '-' }}</td>
                                        <td>{{ $result->ph ?? '-' }}</td>
                                        <td>{{ $result->remarks ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('staff.urinalysis-results.show', $result->id) }}"
                                                class="btn btn-info btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('staff.urinalysis-results.edit', $result->id) }}"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No urinalysis results found.</td>
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
    // Client-side filter for Urinalysis Results
    $(document).ready(function () {
        const $input = $('#searchInput');
        const $tbody = $('#urinalysisTableBody');
        const $count = $('#urinalysisCount');

        if ($input.length && $tbody.length) {
            $input.on('input', function () {
                const q = $(this).val().toLowerCase().trim();
                let visibleRows = 0;
                
                $tbody.find('tr').each(function () {
                    const text = $(this).text().toLowerCase();
                    const isVisible = text.indexOf(q) !== -1;
                    $(this).toggle(isVisible);
                    
                    if (isVisible && !$(this).hasClass('empty-row')) {
                        visibleRows++;
                    }
                });
                
                // Update count
                if ($count.length) {
                    $count.text(visibleRows);
                }
            });
        }
    });
</script>
