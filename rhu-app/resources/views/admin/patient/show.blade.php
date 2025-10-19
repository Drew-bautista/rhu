@extends('layout.app')

@section('content')
    <div>
        <div class=" shadow">
            <div class="card-body px-4 px-md-5 pt-md-5 pt-3">
                <div class="d-md-flex justify-content-between mb-4 mb-m-0">
                    <h1 class="mb-m-4">Patient Details</h1>
                    <div>
                        <a href="{{ route('admin.patient.edit', $patient->id) }}" class="btn btn-primary"><i
                                class="fas fa-edit me-2"></i>Edit</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body px-4 px-md-5 pb-5">
                <p class="card-text"><strong>Name:</strong> {{ $patient->firstname }} {{ $patient->lastname }}</p>
                {{-- <p class="card-text"><strong>Individual:</strong> {{ ucfirst($patient->role) }}</p> --}}
                {{-- <p class="card-text"><strong>Email:</strong> {{ $patient->email }}</p> --}}
                <p class="card-text"><strong>Address:</strong> {{ $patient->address }}</p>
                <p class="card-text"><strong>Sex:</strong> {{ $patient->sex }}</p>
                <p class="card-text"><strong>Birthdate:</strong>
                    {{ \Carbon\Carbon::parse($patient->birthdate)->format('F j, Y') }}</p>
                <p class="card-text"><strong>Contact No:</strong> {{ $patient->contact_no }}</p>
                <p class="card-text"><strong>Emergency Contact:</strong> {{ $patient->emergency_contact }}</p>

            </div>
        </div>
    </div>
    @include('admin.patient.ConfirmationDeleteModal')
@endsection
