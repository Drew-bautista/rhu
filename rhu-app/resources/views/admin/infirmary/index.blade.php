@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="card-header">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6 ">Health Assessment</h1>
                        <a href="{{ route('admin.infirmary.create') }}" class="btn btn-primary btn-sm">
                            Add Data
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        {{-- Search bar only (removed Total) --}}
                        <x-searchBar placeholder="Search patients..." />
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-hover" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="table-light">
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Blood Pressure</th>
                                <th>Diagnosis</th>
                                <th>Chief Complaint</th>
                            </tr>
                        </thead>
                        <tbody id="patientTableBody">
                            @foreach ($infirmary as $infirmaries)
                                <tr style="cursor: pointer;"
                                    onclick="window.location='{{ route('admin.infirmary.show', $infirmaries->id) }}';">

                                    <td>{{ $infirmaries->firstname }} {{ $infirmaries->lastname }}</td>
                                    <td>{{ $infirmaries->sex }}</td>
                                    <td>{{ $infirmaries->address }}</td>
                                    <td>{{ $infirmaries->contact_no }}</td>
                                    <td>{{ $infirmaries->blood_pressure }}</td>
                                    <td>{{ $infirmaries->assessment_diagnosis }}</td>
                                    <td>{{ $infirmaries->chief_complaint }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Client-side search for Health Assessment table
    $(document).ready(function () {
        const $input = $('#searchInput');
        const $tbody = $('#patientTableBody');

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
