@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6 ">Dental Assessment</h1>
                        <a href="{{ route('admin.dental-record.create') }}" class="btn btn-primary btn-sm ">
                            Add Data
                        </a>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search dental records..." />
                    </div>
                </div>

                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover" id="appointmentTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-light">
                                    <th>Name</th>
                                    {{-- <th>Contact </th> --}}
                                    <th>Findings</th>
                                    <th>Tooth/Area Involved</th>
                                    <th>Appointment Date & Time</th>
                                    <th>Services Performed</th>

                                </tr>
                            </thead>
                            <tbody id="appointmentTableBody">
                                @forelse($dentalRecords as $dental)
                                    <tr style="cursor: pointer;"
                                        onclick="window.location='{{ route('admin.dental-record.show', $dental->id) }}'">
                                        <td>
                                            {{ $dental->appointments ? $dental->appointments->name : 'No Appointment' }}
                                        </td>
                                        <td>
                                            {{ $dental->findings }}
                                        </td>
                                        <td>
                                            {{ $dental->tooth_area }}
                                        </td>
                                        <td>
                                            @if($dental->appointments)
                                                {{ \Carbon\Carbon::parse($dental->appointments->date_of_appointment)->format('F j, Y') }} /
                                                {{ \Carbon\Carbon::parse($dental->appointments->time)->format('h:i A') }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            {{ $dental->services }}
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
    // Client-side search filtering for Dental Assessment
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
