@extends('layout.app')
@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6 ">Family Planning</h1>
                        <a href="{{ route('admin.family-planning.create') }}" class="btn btn-primary btn-sm mb-4">
                            Add Data
                        </a>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search family planning records..." />
                    </div>
                </div>

                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover" id="familyPlanningTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-light">
                                    {{-- <th>Date of Visit</th> --}}
                                    <th>Name</th>
                                    <th>FP Counseling</th>
                                    <th>FP Commodity</th>
                                    <th>Facility</th>
                                    <th>Follow up</th>

                                </tr>
                            </thead>
                            <tbody id="familyPlanningTableBody">

                                @foreach ($familyPlannings as $familyPlanning)
                                    <tr style="cursor:pointer;"
                                        onclick="window.location='{{ route('admin.family-planning.show', $familyPlanning->id) }}'">

                                        {{-- <td>
                                            {{ \Carbon\Carbon::parse($familyPlanning->created_at)->format('m/d/Y') }}
                                        </td> --}}
                                        <td>{{ $familyPlanning->name }}</td>
                                        {{-- <td>{{ $familyPlanning->age }}</td>
                                        <td>{{ $familyPlanning->contact }}</td>
                                        <td>{{ $familyPlanning->address }}</td> --}}
                                        <td>{{ $familyPlanning->fp_counseling }}</td>
                                        <td>{{ $familyPlanning->fp_commodity }}</td>
                                        <td>{{ $familyPlanning->facility }}</td>
                                        <td>{{ \Carbon\Carbon::parse($familyPlanning->date_of_follow_up)->format('m/d/Y') }}
                                        </td>
                                    </tr>
                                @endforeach
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
    // Client-side filter for Family Planning
    $(document).ready(function () {
        const $input = $('#searchInput');
        const $tbody = $('#familyPlanningTableBody');

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
