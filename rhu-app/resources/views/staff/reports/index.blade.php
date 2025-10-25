@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-6">Report Generation</h1>
                </div>
            </div>

            {{-- Filter Section --}}
            <div class="card mb-4 no-print">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-filter"></i> Filter Reports</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('staff.reports.index') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" 
                                       value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" 
                                       value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="patient_name" class="form-label">Patient Name</label>
                                <input type="text" class="form-control" id="patient_name" name="patient_name" 
                                       value="{{ request('patient_name') }}" placeholder="Search patient...">
                            </div>
                            <div class="col-md-3">
                                <label for="service" class="form-label">Service</label>
                                <select class="form-control" id="service" name="service">
                                    <option value="">All Services</option>
                                    <option value="General Consultation" {{ request('service') == 'General Consultation' ? 'selected' : '' }}>General Consultation</option>
                                    <option value="Prenatal" {{ request('service') == 'Prenatal' ? 'selected' : '' }}>Prenatal</option>
                                    <option value="Dental" {{ request('service') == 'Dental' ? 'selected' : '' }}>Dental</option>
                                    <option value="Vaccination" {{ request('service') == 'Vaccination' ? 'selected' : '' }}>Vaccination</option>
                                    <option value="Laboratory" {{ request('service') == 'Laboratory' ? 'selected' : '' }}>Laboratory</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Generate Report
                                </button>
                                <a href="{{ route('staff.reports.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                                <button type="button" class="btn btn-success" onclick="window.print()">
                                    <i class="fas fa-print"></i> Print Report
                                </button>
                                <a href="{{ route('staff.reports.export', request()->all()) }}" class="btn btn-info">
                                    <i class="fas fa-download"></i> Export
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Debug Information (only show when filtering) --}}
            @if(request()->has('service') && request('service'))
                <div class="alert alert-info">
                    <strong>Filter Applied:</strong> Service = "{{ request('service') }}" | 
                    <strong>Results Found:</strong> {{ $appointments->total() }} appointments
                    @if($appointments->total() == 0)
                        <br><small>Try checking if appointments exist with service names containing: 
                        @if(request('service') == 'Laboratory')
                            "Laboratory", "Lab", "Test", "CBC", "Urinalysis", "Blood Test"
                        @elseif(request('service') == 'Prenatal')
                            "Prenatal", "Pregnancy", "Prenatal Care"
                        @elseif(request('service') == 'Dental')
                            "Dental", "Tooth", "Oral Health"
                        @elseif(request('service') == 'Vaccination')
                            "Vaccination", "Vaccine", "Immunization"
                        @elseif(request('service') == 'General Consultation')
                            "General Consultation", "Consultation", "Checkup"
                        @endif
                        </small>
                    @endif
                </div>
            @endif

            {{-- Statistics Cards --}}
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Appointments</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['total_appointments'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Completed</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['completed_appointments'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pending</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['pending_appointments'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clock fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Services</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $statistics['total_infirmary'] + $statistics['total_dental'] + $statistics['total_prenatal'] + $statistics['total_vaccines'] }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-hospital fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Service Breakdown --}}
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Service Breakdown</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 text-center">
                                    <h6>Health Assessment</h6>
                                    <h3 class="text-primary">{{ $statistics['total_infirmary'] }}</h3>
                                </div>
                                <div class="col-md-2 text-center">
                                    <h6>Dental</h6>
                                    <h3 class="text-success">{{ $statistics['total_dental'] }}</h3>
                                </div>
                                <div class="col-md-2 text-center">
                                    <h6>Prenatal</h6>
                                    <h3 class="text-warning">{{ $statistics['total_prenatal'] }}</h3>
                                </div>
                                <div class="col-md-2 text-center">
                                    <h6>TB-DOTS</h6>
                                    <h3 class="text-danger">{{ $statistics['total_tbdots'] }}</h3>
                                </div>
                                <div class="col-md-2 text-center">
                                    <h6>Vaccines</h6>
                                    <h3 class="text-info">{{ $statistics['total_vaccines'] }}</h3>
                                </div>
                                <div class="col-md-2 text-center">
                                    <h6>Animal Bites</h6>
                                    <h3 class="text-secondary">{{ $statistics['total_animal_bites'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Patient History Table --}}
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Patient Check-up History</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="table-light">
                                    <th>Date</th>
                                    <th>Patient Name</th>
                                    <th>Age</th>
                                    <th>Contact</th>
                                    <th>Service</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($appointments as $appointment)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($appointment->date_of_appointment)->format('M d, Y') }}</td>
                                        <td><strong>{{ $appointment->name }}</strong></td>
                                        <td>{{ $appointment->age }}</td>
                                        <td>{{ $appointment->contact_number }}</td>
                                        <td>{{ $appointment->service }}</td>
                                        <td>
                                            @if($appointment->status == 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @elseif($appointment->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @else
                                                <span class="badge bg-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('staff.reports.patient-history', $appointment->name) }}" 
                                               class="btn btn-sm btn-info" title="View Full History">
                                                <i class="fas fa-history"></i> History
                                            </a>
                                            <a href="{{ route('staff.appointments.show', $appointment->id) }}" 
                                               class="btn btn-sm btn-primary" title="View Details">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No appointments found for the selected criteria.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {{ $appointments->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="card mt-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Quick Report Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('staff.reports.monthly', [date('n'), date('Y')]) }}" 
                               class="btn btn-primary btn-block">
                                <i class="fas fa-calendar-alt"></i> Current Month Report
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('staff.reports.monthly', [date('n', strtotime('-1 month')), date('Y', strtotime('-1 month'))]) }}" 
                               class="btn btn-info btn-block">
                                <i class="fas fa-calendar-minus"></i> Last Month Report
                            </a>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-success btn-block" data-bs-toggle="modal" data-bs-target="#customReportModal">
                                <i class="fas fa-chart-bar"></i> Custom Report
                            </button>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('staff.reports.export', ['start_date' => date('Y-m-01'), 'end_date' => date('Y-m-t')]) }}" 
                               class="btn btn-warning btn-block">
                                <i class="fas fa-file-excel"></i> Export This Month
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Report Modal --}}
    <div class="modal fade" id="customReportModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('staff.reports.index') }}" method="GET">
                    <div class="modal-header">
                        <h5 class="modal-title">Generate Custom Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="custom_start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="custom_end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="custom_service" class="form-label">Service Type</label>
                            <select class="form-control" name="service">
                                <option value="">All Services</option>
                                <option value="General Consultation">General Consultation</option>
                                <option value="Prenatal">Prenatal</option>
                                <option value="Dental">Dental</option>
                                <option value="Vaccination">Vaccination</option>
                                <option value="Laboratory">Laboratory</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Generate Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .btn, .modal, form, .pagination {
                display: none !important;
            }
            .card {
                border: 1px solid #000 !important;
            }
        }
    </style>
@endsection
