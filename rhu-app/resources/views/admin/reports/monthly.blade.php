@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="display-6">Monthly Report: {{ date('F Y', mktime(0, 0, 0, $month, 1, $year)) }}</h1>
                        <div>
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

            {{-- Summary Statistics --}}
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Appointments</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['appointments']->count() }}</div>
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
                                        Health Assessments</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['infirmary']->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-heartbeat fa-2x text-gray-300"></i>
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
                                        Vaccines Given</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['vaccines']->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-syringe fa-2x text-gray-300"></i>
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
                                        Total Services</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $data['appointments']->count() + $data['infirmary']->count() + $data['dental']->count() + $data['prenatal']->count() + $data['vaccines']->count() }}
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
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Service Breakdown for {{ date('F Y', mktime(0, 0, 0, $month, 1, $year)) }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="serviceChart"></canvas>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Service Type</th>
                                        <th>Count</th>
                                        <th>Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = $data['infirmary']->count() + $data['dental']->count() + $data['prenatal']->count() + $data['tbdots']->count() + $data['vaccines']->count() + $data['animal_bites']->count();
                                        $services = [
                                            'Health Assessment' => $data['infirmary']->count(),
                                            'Dental' => $data['dental']->count(),
                                            'Prenatal' => $data['prenatal']->count(),
                                            'TB-DOTS' => $data['tbdots']->count(),
                                            'Vaccines' => $data['vaccines']->count(),
                                            'Animal Bites' => $data['animal_bites']->count(),
                                        ];
                                    @endphp
                                    @foreach($services as $service => $count)
                                        <tr>
                                            <td>{{ $service }}</td>
                                            <td>{{ $count }}</td>
                                            <td>{{ $total > 0 ? round(($count / $total) * 100, 1) : 0 }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Appointments List --}}
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Appointments This Month</h5>
                </div>
                <div class="card-body">
                    @if($data['appointments']->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-light">
                                        <th>Date</th>
                                        <th>Patient Name</th>
                                        <th>Service</th>
                                        <th>Status</th>
                                        <th>Contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['appointments'] as $appointment)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($appointment->date_of_appointment)->format('M d, Y') }}</td>
                                            <td>{{ $appointment->name }}</td>
                                            <td>{{ $appointment->service }}</td>
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
                        <p class="text-muted">No appointments this month.</p>
                    @endif
                </div>
            </div>

            {{-- Health Assessments --}}
            @if($data['infirmary']->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Health Assessments</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-light">
                                        <th>Date</th>
                                        <th>Patient Name</th>
                                        <th>Age</th>
                                        <th>Weight (kg)</th>
                                        <th>Height (cm)</th>
                                        <th>Blood Pressure</th>
                                        <th>Temperature</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['infirmary'] as $record)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($record->created_at)->format('M d, Y') }}</td>
                                            <td>{{ $record->firstname }} {{ $record->lastname }}</td>
                                            <td>{{ $record->age }}</td>
                                            <td>{{ $record->weight ?? 'N/A' }}</td>
                                            <td>{{ $record->height ?? 'N/A' }}</td>
                                            <td>{{ $record->blood_pressure ?? 'N/A' }}</td>
                                            <td>{{ $record->temperature ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Vaccines Given --}}
            @if($data['vaccines']->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Vaccines Administered</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-light">
                                        <th>Date</th>
                                        <th>Patient</th>
                                        <th>Vaccine Type</th>
                                        <th>Dose</th>
                                        <th>Age Group</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['vaccines'] as $vaccine)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($vaccine->date_administered)->format('M d, Y') }}</td>
                                            <td>{{ $vaccine->patient_name }}</td>
                                            <td>{{ $vaccine->vaccine_type }}</td>
                                            <td>{{ $vaccine->dose_number }}</td>
                                            <td>{{ ucfirst($vaccine->age_group) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            {{-- TB-DOTS Cases --}}
            @if($data['tbdots']->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">TB-DOTS Cases</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-light">
                                        <th>Patient</th>
                                        <th>TB Type</th>
                                        <th>Category</th>
                                        <th>Treatment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['tbdots'] as $tbdot)
                                        <tr>
                                            <td>{{ $tbdot->patient_name }}</td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $tbdot->tb_type)) }}</td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $tbdot->treatment_category)) }}</td>
                                            <td>
                                                @if($tbdot->treatment_status == 'ongoing')
                                                    <span class="badge bg-primary">Ongoing</span>
                                                @elseif($tbdot->treatment_status == 'completed')
                                                    <span class="badge bg-success">Completed</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($tbdot->treatment_status) }}</span>
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

            {{-- Summary Footer --}}
            <div class="card">
                <div class="card-body text-center">
                    <p class="mb-0">
                        <strong>Report Generated:</strong> {{ now()->format('F d, Y h:i A') }}<br>
                        <strong>Generated By:</strong> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}<br>
                        <strong>Rural Health Unit Gabaldon</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Service Breakdown Chart
        const ctx = document.getElementById('serviceChart').getContext('2d');
        const serviceChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Health Assessment', 'Dental', 'Prenatal', 'TB-DOTS', 'Vaccines', 'Animal Bites'],
                datasets: [{
                    data: [
                        {{ $data['infirmary']->count() }},
                        {{ $data['dental']->count() }},
                        {{ $data['prenatal']->count() }},
                        {{ $data['tbdots']->count() }},
                        {{ $data['vaccines']->count() }},
                        {{ $data['animal_bites']->count() }}
                    ],
                    backgroundColor: [
                        '#28a745',
                        '#ffc107',
                        '#e91e63',
                        '#dc3545',
                        '#17a2b8',
                        '#343a40'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Service Distribution'
                    }
                }
            }
        });
    </script>

    <style>
        @media print {
            .btn, button {
                display: none !important;
            }
            .card {
                border: 1px solid #000 !important;
                page-break-inside: avoid;
            }
            canvas {
                max-height: 300px !important;
            }
        }
    </style>
@endsection
