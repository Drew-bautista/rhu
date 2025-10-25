@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-3 p-m-5">
        <div class="card-header">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6 fw-bolder text-uppercase">Treatment Record</h1>
                        <a href="{{ route('admin.treatment.create') }}" class="btn btn-primary btn-sm ">
                            Add Treatment Record
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <strong>Total:</strong>
                            </div>
                            <div class="h5 ms-1 mb-1.5 font-weight-bold text-gray-800" id="patientCount">
                                {{ $treatments->count() }}</div>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search..." />
                    </div>
                </div>
            </div>
            <div class="">

                <div class="table table-responsive">
                    <table class="table table-hover" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Patient Name</th>
                                <th>Consultation Date</th>
                                <th>Chief Complaint</th>
                                <th>Assessment & Diagnosis</th>
                                <th>Medication & Treatment</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($treatments as $treatment)
                                <tr onclick="window.location='{{ route('admin.treatment.show', $treatment->id) }}';"
                                    style="cursor: pointer;">
                                    <td>{{ $treatment->id }}</td>
                                    <td>{{ $treatment->patient->firstname }} {{ $treatment->patient->lastname }}</td>
                                    <td>{{ \Carbon\Carbon::parse($treatment->consultation_date_time)->format('M-d-Y h:i A') }}
                                    </td>
                                    </td>
                                    <td>{{ $treatment->chief_complaint }}</td>
                                    <td>{{ $treatment->assessment_diagnosis }}</td>
                                    <td>
                                        {{ $treatment->medication_treatment ?: 'No medication/treatment recorded' }}
                                        {{-- DEBUG: {{ $treatment->medication_treatment ?? 'NULL' }} --}}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.treatment.show', $treatment->id) }}"
                                            class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('admin.treatment.edit', $treatment->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.treatment.delete', $treatment->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this treatment?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No treatment records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let timer = null; // Debounce timer

        $('#searchInput').on('keyup', function() {
            clearTimeout(timer); // I-clear ang previous timer
            let query = $(this).val().trim();

            timer = setTimeout(() => {
                $.ajax({
                    url: "/doctor/treatments/search", // Adjust based on your route
                    type: 'GET',
                    data: {
                        search: query
                    },
                    success: function(data) {
                        let tableBody = $('#treatmentTableBody');
                        tableBody.empty();

                        if (data.length > 0) {
                            $.each(data, function(index, treatment) {
                                let patientName = treatment.user ?
                                    `${treatment.user.firstname} ${treatment.user.lastname}` :
                                    'Unknown';
                                let medicalHistory = treatment
                                    .health_assessment?.medical_history ||
                                    'N/A';
                                let allergies = treatment.health_assessment
                                    ?.allergies || 'N/A';
                                let symptoms = treatment.health_assessment
                                    ?.symptoms || 'N/A';
                                let bloodPressure = treatment
                                    .health_assessment?.blood_pressure ||
                                    'N/A';

                                let treatmentUrl = encodeURI(
                                    `/treatment/${treatment.id}`);

                                let row = `<tr onclick="window.location='${treatmentUrl}';" style="cursor: pointer;">
                                        <td>${patientName}</td>
                                        <td>${medicalHistory}</td>
                                        <td>${allergies}</td>
                                        <td>${symptoms}</td>
                                        <td>${bloodPressure}</td>
                                    </tr>`;
                                tableBody.append(row);
                            });
                        } else {
                            tableBody.append(
                                '<tr><td colspan="5" class="text-center text-muted">No treatments found.</td></tr>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', status, error);
                    }
                });
            }, 300); // 300ms debounce
        });
    });
</script>
