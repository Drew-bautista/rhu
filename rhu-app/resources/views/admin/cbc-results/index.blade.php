@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6 ">CBC Results</h1>
                        <a href="{{ route('admin.cbc-results.create') }}" class="btn btn-primary btn-sm ">
                            Add Data
                        </a>
                    </div>
                   </div>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search CBC..." />
                    </div>
                </div>

                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover" id="appointmentTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-light">
                                    <th>Name</th>
                                    {{-- <th>Test Date</th> --}}
                                    <th>Hemoglobin</th>
                                    <th>Hematocrit</th>
                                    <th>RBC</th>
                                    <th>WBC</th>
                                    <th>Platelet</th>


                                </tr>
                            </thead>
                            <tbody id="appointmentTableBody">
                                @forelse($cbcResults as $cbcResult)
                                    <tr style="cursor: pointer;"
                                        onclick="window.location='{{ route('admin.cbc-results.show', $cbcResult->id) }}'">
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
                                        {{-- <td>
                                            {{ \Carbon\Carbon::parse($cbcResult->appointment_date)->format('Y/m/d') }} /
                                            {{ \Carbon\Carbon::parse($cbcResult->time)->format('h:i A') }}
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No appointments found.</td>
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
    // Client-side search filtering for CBC Results
    $(document).ready(function () {
        const $input = $('#searchInput');
        const $tbody = $('#appointmentTableBody');

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
