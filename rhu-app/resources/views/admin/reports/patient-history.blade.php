@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="display-6">Patient History: {{ $patientName }}</h1>
                        <div class="no-print">
                            <button onclick="window.print()" class="btn btn-success">
                                <i class="fas fa-print"></i> Print
                            </button>
                            <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Patient Summary Card --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Patient Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Total Visits:</strong>
                            <h4 class="text-primary">{{ $appointments->count() }}</h4>
                        </div>
                        <div class="col-md-3">
                            <strong>First Visit:</strong>
                            <h6>{{ $appointments->last() ? \Carbon\Carbon::parse($appointments->last()->date_of_appointment)->format('M d, Y') : 'N/A' }}</h6>
                        </div>
                        <div class="col-md-3">
                            <strong>Last Visit:</strong>
                            <h6>{{ $appointments->first() ? \Carbon\Carbon::parse($appointments->first()->date_of_appointment)->format('M d, Y') : 'N/A' }}</h6>
                        </div>
                        <div class="col-md-3">
                            <strong>Most Common Service:</strong>
                            <h6>{{ $appointments->groupBy('service')->sortByDesc(function($group) { return $group->count(); })->keys()->first() ?? 'N/A' }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Appointments History --}}
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-calendar"></i> Appointment History</h5>
                </div>
                <div class="card-body">
                    @if($appointments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-light">
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Service</th>
                                        <th>Age at Visit</th>
                                        <th>Status</th>
                                        <th>Contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($appointment->date_of_appointment)->format('M d, Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>
                                            <td>{{ $appointment->service }}</td>
                                            <td>{{ $appointment->age }} years</td>
                                            <td>
                                                @if($appointment->status == 'completed')
                                                    <span class="badge bg-success">Completed</span>
                                                @elseif($appointment->status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-danger">{{ ucfirst($appointment->status) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $appointment->contact_number }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No appointment records found.</p>
                    @endif
                </div>
            </div>

            {{-- Health Assessment Records --}}
            @if($infirmaryRecords->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-heartbeat"></i> Health Assessment Records</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-light">
                                        <th>Date</th>
                                        <th>Blood Pressure</th>
                                        <th>Chief Complaint</th>
                                        <th>Diagnosis</th>
                                        <th>Treatment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($infirmaryRecords as $record)
                                        <tr>
                                            <td>{{ $record->created_at->format('M d, Y') }}</td>
                                            <td>{{ $record->blood_pressure ?? 'N/A' }}</td>
                                            <td>{{ $record->chief_complaint ?? 'N/A' }}</td>
                                            <td>{{ $record->assessment_diagnosis ?? 'N/A' }}</td>
                                            <td>{{ $record->treatment ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Dental Records --}}
            @if($dentalRecords->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0"><i class="fas fa-tooth"></i> Dental Records</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-light">
                                        <th>Date</th>
                                        <th>Findings</th>
                                        <th>Tooth/Area</th>
                                        <th>Services Performed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dentalRecords as $record)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($record->appointment_date)->format('M d, Y') }}</td>
                                            <td>{{ $record->findings }}</td>
                                            <td>{{ $record->tooth_area }}</td>
                                            <td>{{ $record->services }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Prenatal Records --}}
            @if($prenatalRecords->count() > 0)
                <div class="card mb-4">
                    <div class="card-header" style="background-color: #e91e63; color: white;">
                        <h5 class="mb-0"><i class="fas fa-baby"></i> Prenatal Records</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-light">
                                        <th>Date</th>
                                        <th>Height</th>
                                        <th>Weight</th>
                                        <th>Blood Pressure</th>
                                        <th>Age of Gestation</th>
                                        <th>Nutritional Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prenatalRecords as $record)
                                        <tr>
                                            <td>{{ $record->created_at->format('M d, Y') }}</td>
                                            <td>{{ $record->height }} cm</td>
                                            <td>{{ $record->weight }} kg</td>
                                            <td>{{ $record->blood_pressure }}</td>
                                            <td>{{ $record->age_of_gestation }} weeks</td>
                                            <td>
                                                @if($record->nutritional_status == 'underweight')
                                                    <span class="badge bg-warning">Underweight</span>
                                                @elseif($record->nutritional_status == 'normal')
                                                    <span class="badge bg-success">Normal</span>
                                                @elseif($record->nutritional_status == 'overweight')
                                                    <span class="badge bg-info">Overweight</span>
                                                @else
                                                    {{ ucfirst($record->nutritional_status ?? 'N/A') }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            {{-- TB-DOTS Records --}}
            @if($tbdotRecords->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0"><i class="fas fa-lungs"></i> TB-DOTS Records</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-light">
                                        <th>Diagnosis Date</th>
                                        <th>TB Type</th>
                                        <th>Category</th>
                                        <th>Treatment Start</th>
                                        <th>Treatment End</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tbdotRecords as $record)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($record->date_of_diagnosis)->format('M d, Y') }}</td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $record->tb_type)) }}</td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $record->treatment_category)) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($record->treatment_start_date)->format('M d, Y') }}</td>
                                            <td>{{ $record->treatment_end_date ? \Carbon\Carbon::parse($record->treatment_end_date)->format('M d, Y') : 'Ongoing' }}</td>
                                            <td>
                                                @if($record->treatment_status == 'ongoing')
                                                    <span class="badge bg-primary">Ongoing</span>
                                                @elseif($record->treatment_status == 'completed')
                                                    <span class="badge bg-success">Completed</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($record->treatment_status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Vaccine Records --}}
            @if($vaccineRecords->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-syringe"></i> Vaccine Records</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-light">
                                        <th>Date Administered</th>
                                        <th>Vaccine Type</th>
                                        <th>Dose</th>
                                        <th>Next Dose</th>
                                        <th>Administered By</th>
                                        <th>Reactions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vaccineRecords as $record)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($record->date_administered)->format('M d, Y') }}</td>
                                            <td>{{ $record->vaccine_type }}</td>
                                            <td>{{ $record->dose_number }}</td>
                                            <td>{{ $record->next_dose_date ? \Carbon\Carbon::parse($record->next_dose_date)->format('M d, Y') : 'Completed' }}</td>
                                            <td>{{ $record->administered_by }}</td>
                                            <td>{{ $record->adverse_reactions ?? 'None' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Animal Bite Records --}}
            @if($animalBiteRecords->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="fas fa-dog"></i> Animal Bite Records</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-light">
                                        <th>Incident Date</th>
                                        <th>Animal Type</th>
                                        <th>Bite Site</th>
                                        <th>Category</th>
                                        <th>ARV Dose</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($animalBiteRecords as $record)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($record->date_of_incident)->format('M d, Y') }}</td>
                                            <td>{{ $record->animal_type }}</td>
                                            <td>{{ $record->bite_site }}</td>
                                            <td>{{ $record->bite_category }}</td>
                                            <td>{{ $record->arv_dose ?? 'N/A' }}</td>
                                            <td>{{ $record->remarks ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Summary Statistics --}}
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Service Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-2">
                            <h6>Appointments</h6>
                            <h3 class="text-primary">{{ $appointments->count() }}</h3>
                        </div>
                        <div class="col-md-2">
                            <h6>Health Assessments</h6>
                            <h3 class="text-success">{{ $infirmaryRecords->count() }}</h3>
                        </div>
                        <div class="col-md-2">
                            <h6>Dental</h6>
                            <h3 class="text-warning">{{ $dentalRecords->count() }}</h3>
                        </div>
                        <div class="col-md-2">
                            <h6>Prenatal</h6>
                            <h3 style="color: #e91e63;">{{ $prenatalRecords->count() }}</h3>
                        </div>
                        <div class="col-md-2">
                            <h6>Vaccines</h6>
                            <h3 class="text-info">{{ $vaccineRecords->count() }}</h3>
                        </div>
                        <div class="col-md-2">
                            <h6>Animal Bites</h6>
                            <h3 class="text-dark">{{ $animalBiteRecords->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .btn, button {
                display: none !important;
            }
            .card {
                border: 1px solid #000 !important;
                page-break-inside: avoid;
            }
            .card-header {
                background-color: #f8f9fa !important;
                color: #000 !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
@endsection
