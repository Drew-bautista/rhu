@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6 ">Dental Records</h1>
                        <a href="{{ route('staff.dental-record.create') }}" class="btn btn-primary btn-sm">
                            Add Data
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
                        <x-searchBar placeholder="Search appointments..." />
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="appointmentTableBody">
                                @forelse($dentalRecords as $dental)
                                    <tr>
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
                                        <td>
                                            <a href="{{ route('staff.dental-record.show', $dental->id) }}" 
                                               class="btn btn-info btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('staff.dental-record.edit', $dental->id) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No dental records found.</td>
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
    // Client-side search functionality for dental records
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            let query = $(this).val().toLowerCase().trim();
            let visibleRows = 0;

            $('#appointmentTable tbody tr').each(function() {
                let row = $(this);
                let text = row.text().toLowerCase();
                
                if (text.includes(query)) {
                    row.show();
                    visibleRows++;
                } else {
                    row.hide();
                }
            });

            // Update count if there's a counter element
            if ($('#appointmentCount').length) {
                $('#appointmentCount').text(visibleRows);
            }
        });
    });
</script>
