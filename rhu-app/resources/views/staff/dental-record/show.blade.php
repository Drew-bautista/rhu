@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Dental Record</h3>


                <!-- Patient Information Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h5 class="text-primary">Patient Details</h5>
                        <div>

                            <form action="{{ route('staff.dental-record.destroy', $dentalRecords->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                {{-- <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $dentalRecords->id }}">
                                    Delete
                                </button> --}}

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $dentalRecords->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $dentalRecords->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $dentalRecords->id }}">
                                                    Confirm
                                                    Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this data?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="position-absolute top-0 end-0 mt-4 me-4">
                        <a href="{{ route('staff.dental-record.index') }}" class="text-dark" style="font-size: 1.25rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>

                    <hr>
                    <p>
                        <strong>Name:</strong> {{ $dentalRecords->appointments ? $dentalRecords->appointments->name : 'N/A' }}
                    </p>
                    <p>
                        <strong>Age:</strong> {{ $dentalRecords->appointments ? $dentalRecords->appointments->age : 'N/A' }}
                    </p>
                    <p>
                        <strong>Contact:</strong> {{ $dentalRecords->appointments ? $dentalRecords->appointments->contact_number : 'N/A' }}
                    </p>
                    <p>
                        <strong>Address:</strong> {{ $dentalRecords->appointments ? $dentalRecords->appointments->address : 'N/A' }}
                    </p>
                    {{-- <p>
                        <strong>Service:</strong> {{ $dentalRecords->appointments->service }}
                    </p> --}}
                    <p>
                        <strong>Appointment Date & Time:</strong>
                        @if($dentalRecords->appointments)
                            {{ \Carbon\Carbon::parse($dentalRecords->appointments->date_of_appointment)->format('F j, Y') }} /
                            {{ \Carbon\Carbon::parse($dentalRecords->appointments->time)->format('h:i A') }}
                        @else
                            N/A
                        @endif
                    </p>
                    <p><strong>Date of Birth:</strong>
                        @if($dentalRecords->appointments && $dentalRecords->appointments->date_of_birth)
                            {{ \Carbon\Carbon::parse($dentalRecords->appointments->date_of_birth)->format('Y-m-d') }}
                        @else
                            N/A
                        @endif
                    </p>
                    {{-- <p><strong>Gender:</strong> {{ ucfirst($dentalRecords->sex) }}</p> --}}
                    <p>
                        <strong>Emergency Contact:</strong> {{ $dentalRecords->appointments ? $dentalRecords->appointments->emergency_contact : 'N/A' }}
                    </p>

                </div>
                <!-- Health Assessment Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-primary">Dental Details</h5>
                        {{-- <a href="{{ route('admin.dental-record.edit', $dentalRecords->id) }}"
                            class="btn btn-warning btn-sm">Update Data</a> --}}
                    </div>

                    <hr>
                    <p>
                        <strong>Services Performed:</strong> {{ $dentalRecords->services ?? 'N/A' }}
                    </p>
                    <p>
                        <strong>Tooth/Area Involved:</strong> {{ $dentalRecords->tooth_area ?? 'N/A' }}
                    </p>
                    <p>
                        <strong>Findings:</strong> {{ $dentalRecords->findings ?? 'N/A' }}
                    </p>
                    <p>
                        <strong>Prescription:</strong> {{ $dentalRecords->prescription ?? 'N/A' }}
                    </p>

                </div>



            </div>
        </div>
    </div>
@endsection
