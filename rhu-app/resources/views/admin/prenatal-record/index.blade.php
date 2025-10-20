@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6 ">Prenatal Record</h1>
                        <a href="{{ route('admin.prenatal-record.create') }}" class="btn btn-primary btn-sm ">
                            Add Prenatal Record
                        </a>
                    </div>
                </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search prenatal records..." />
                    </div>
                </div>

                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover" id="appointmentTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-light">
                                    {{-- <th>ID</th> --}}
                                    <th>Name</th>
                                    <th>Height</th>
                                    <th>Weight</th>
                                    <th>Blood Pressure</th>
                                    <th>Age of Gestation</th>
                                    <th>Nutrition</th>

                                </tr>
                            </thead>
                            <tbody id="appointmentTableBody">
                                @forelse($prenatalRecords as $prenatal)
                                    <tr style="cursor: pointer;"
                                        onclick="window.location='{{ route('admin.prenatal-record.show', $prenatal->id) }}'">
                                        <td>{{ $prenatal->appointments->name }}</td>
                                        <td>{{ $prenatal->height }}</td>
                                        <td>{{ $prenatal->weight }}</td>
                                        <td>{{ $prenatal->blood_pressure }}
                                        </td>
                                        <td>{{ $prenatal->age_of_gestation }}</td>
                                        <td>
                                            @if ($prenatal->nutritional_status == 'underweight')
                                                <span class="badge bg-warning text-dark">Underweight</span>
                                            @elseif($prenatal->nutritional_status == 'normal')
                                                <span class="badge bg-success">Normal</span>
                                            @elseif($prenatal->nutritional_status == 'overweight')
                                                <span class="badge bg-info text-dark">Overweight</span>
                                            @else
                                                <span class="text-muted">Not Set</span>
                                            @endif
                                        </td>
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
    // Client-side filter for Prenatal Records
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
