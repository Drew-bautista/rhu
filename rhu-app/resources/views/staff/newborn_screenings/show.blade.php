@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Newborn Screening Details</h3>

                <div class="position-absolute top-0 end-0 mt-4 me-4">
                    <a href="{{ route('staff.newborn_screenings.index') }}" class="text-dark" style="font-size: 1.25rem;">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="text-primary">Baby Information</h5>
                    {{-- <div>
                        <a href="{{ route('admin.newborn_screenings.edit', $newborn_screening->id) }}"
                            class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.newborn_screenings.destroy', $newborn_screening->id) }}"
                            method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $newborn_screening->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $newborn_screening->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $newborn_screening->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $newborn_screening->id }}">
                                                Confirm Deletion</h5>
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
                        </form>
                    </div> --}}
                </div>

                <hr>

                {{-- 🍼 Baby Info --}}
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>First Name:</strong> {{ $newborn_screening->first_name }}</p>
                        <p><strong>Middle Name:</strong> {{ $newborn_screening->middle_name ?? 'N/A' }}</p>
                        <p><strong>Last Name:</strong> {{ $newborn_screening->last_name }}</p>
                        <p><strong>Sex:</strong> {{ $newborn_screening->sex }}</p>
                        <p><strong>Date of Birth:</strong>
                            {{ \Carbon\Carbon::parse($newborn_screening->date_of_birth)->format('F j, Y') }}
                        </p>
                        <p><strong>Time of Birth:</strong> {{ $newborn_screening->time_of_birth ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Birth Weight:</strong> {{ $newborn_screening->birth_weight ?? 'N/A' }} kg</p>
                        <p><strong>Gestational Age:</strong> {{ $newborn_screening->gestational_age ?? 'N/A' }} weeks</p>
                        <p><strong>Place of Birth:</strong> {{ $newborn_screening->place_of_birth ?? 'N/A' }}</p>
                    </div>
                </div>

                {{-- 👩‍🍼 Mother Info --}}
                <h5 class="text-primary mt-4">Mother Information</h5>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $newborn_screening->mother_name }}</p>
                        <p><strong>Age:</strong> {{ $newborn_screening->mother_age ?? 'N/A' }}</p>
                        <p><strong>Contact:</strong> {{ $newborn_screening->mother_contact ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Address:</strong> {{ $newborn_screening->mother_address ?? 'N/A' }}</p>
                    </div>
                </div>

                {{-- 🧾 Screening Details --}}
                <h5 class="text-primary mt-4">Screening Details</h5>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Screening Date:</strong>
                            {{ \Carbon\Carbon::parse($newborn_screening->screening_date)->format('F j, Y') }}
                        </p>
                        <p><strong>Facility:</strong> {{ $newborn_screening->facility ?? 'N/A' }}</p>
                        <p><strong>Kit No.:</strong> {{ $newborn_screening->kit_no ?? 'N/A' }}</p>
                        <p><strong>Sample Collection At:</strong>
                            {{ $newborn_screening->sample_collection_at
                                ? \Carbon\Carbon::parse($newborn_screening->sample_collection_at)->format('F j, Y h:i A')
                                : 'N/A' }}
                        </p>
                        <p><strong>Specimen Type:</strong> {{ $newborn_screening->specimen_type ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Conditions Tested:</strong> {{ $newborn_screening->conditions_tested ?? 'N/A' }}</p>
                        <p><strong>Result Status:</strong> {{ $newborn_screening->result_status }}</p>
                        <p><strong>Remarks:</strong> {{ $newborn_screening->remarks ?? 'N/A' }}</p>
                        <p><strong>Provider Name:</strong> {{ $newborn_screening->provider_name ?? 'N/A' }}</p>
                        <p><strong>Provider Role:</strong> {{ $newborn_screening->provider_role ?? 'N/A' }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
