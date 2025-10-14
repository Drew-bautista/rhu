<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rural Health Unit Report Export</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            border-bottom: 2px solid #333;
        }
        
        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .header h2 {
            font-size: 18px;
            font-weight: normal;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 14px;
            color: #666;
        }
        
        .section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            padding: 5px;
            background-color: #f0f0f0;
            border-left: 4px solid #007bff;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .summary-box {
            display: inline-block;
            width: 23%;
            margin: 1%;
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
            background-color: #f8f9fa;
        }
        
        .summary-box h3 {
            font-size: 24px;
            color: #007bff;
            margin-bottom: 5px;
        }
        
        .summary-box p {
            font-size: 12px;
            color: #666;
        }
        
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 11px;
            color: #666;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }
        
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .badge-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        @media print {
            body {
                font-size: 11px;
            }
            
            .section {
                page-break-inside: avoid;
            }
            
            .header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
            }
            
            .footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>RURAL HEALTH UNIT GABALDON</h1>
        <h2>Health Services Report</h2>
        <p>
            @if(request('start_date') && request('end_date'))
                Period: {{ \Carbon\Carbon::parse(request('start_date'))->format('F d, Y') }} - 
                {{ \Carbon\Carbon::parse(request('end_date'))->format('F d, Y') }}
            @else
                Generated on: {{ now()->format('F d, Y') }}
            @endif
        </p>
    </div>

    {{-- Summary Statistics --}}
    <div class="section">
        <div class="section-title">Summary Statistics</div>
        <div style="text-align: center;">
            <div class="summary-box">
                <h3>{{ $appointments->count() }}</h3>
                <p>Total Appointments</p>
            </div>
            <div class="summary-box">
                <h3>{{ $appointments->where('status', 'completed')->count() }}</h3>
                <p>Completed</p>
            </div>
            <div class="summary-box">
                <h3>{{ $appointments->where('status', 'pending')->count() }}</h3>
                <p>Pending</p>
            </div>
            <div class="summary-box">
                <h3>{{ $appointments->unique('name')->count() }}</h3>
                <p>Unique Patients</p>
            </div>
        </div>
    </div>

    {{-- Service Distribution --}}
    <div class="section">
        <div class="section-title">Service Distribution</div>
        <table>
            <thead>
                <tr>
                    <th>Service Type</th>
                    <th>Count</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $services = $appointments->groupBy('service');
                    $total = $appointments->count();
                @endphp
                @foreach($services as $service => $items)
                    <tr>
                        <td>{{ $service }}</td>
                        <td>{{ $items->count() }}</td>
                        <td>{{ $total > 0 ? round(($items->count() / $total) * 100, 1) : 0 }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Appointment Details --}}
    <div class="section">
        <div class="section-title">Appointment Details</div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Patient Name</th>
                    <th>Age</th>
                    <th>Contact</th>
                    <th>Service</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $index => $appointment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->date_of_appointment)->format('M d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>
                        <td>{{ $appointment->name }}</td>
                        <td>{{ $appointment->age }}</td>
                        <td>{{ $appointment->contact_number }}</td>
                        <td>{{ $appointment->service }}</td>
                        <td>
                            @if($appointment->status == 'completed')
                                <span class="badge badge-success">Completed</span>
                            @elseif($appointment->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @else
                                <span class="badge badge-danger">{{ ucfirst($appointment->status) }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Age Distribution --}}
    <div class="section">
        <div class="section-title">Age Distribution</div>
        <table>
            <thead>
                <tr>
                    <th>Age Group</th>
                    <th>Count</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $ageGroups = [
                        '0-5' => $appointments->whereBetween('age', [0, 5])->count(),
                        '6-12' => $appointments->whereBetween('age', [6, 12])->count(),
                        '13-17' => $appointments->whereBetween('age', [13, 17])->count(),
                        '18-30' => $appointments->whereBetween('age', [18, 30])->count(),
                        '31-50' => $appointments->whereBetween('age', [31, 50])->count(),
                        '51-65' => $appointments->whereBetween('age', [51, 65])->count(),
                        '65+' => $appointments->where('age', '>', 65)->count(),
                    ];
                @endphp
                @foreach($ageGroups as $group => $count)
                    <tr>
                        <td>{{ $group }} years</td>
                        <td>{{ $count }}</td>
                        <td>{{ $total > 0 ? round(($count / $total) * 100, 1) : 0 }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Monthly Breakdown (if date range spans multiple months) --}}
    @if(request('start_date') && request('end_date'))
        @php
            $monthlyData = $appointments->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->date_of_appointment)->format('Y-m');
            });
        @endphp
        @if($monthlyData->count() > 1)
            <div class="section">
                <div class="section-title">Monthly Breakdown</div>
                <table>
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Total Appointments</th>
                            <th>Completed</th>
                            <th>Pending</th>
                            <th>Cancelled</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($monthlyData as $month => $items)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($month . '-01')->format('F Y') }}</td>
                                <td>{{ $items->count() }}</td>
                                <td>{{ $items->where('status', 'completed')->count() }}</td>
                                <td>{{ $items->where('status', 'pending')->count() }}</td>
                                <td>{{ $items->where('status', 'cancelled')->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endif

    {{-- Top Patients --}}
    <div class="section">
        <div class="section-title">Most Frequent Patients</div>
        <table>
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Number of Visits</th>
                    <th>Most Recent Visit</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $topPatients = $appointments->groupBy('name')
                        ->map(function($group) {
                            return [
                                'count' => $group->count(),
                                'latest' => $group->sortByDesc('date_of_appointment')->first()
                            ];
                        })
                        ->sortByDesc('count')
                        ->take(10);
                @endphp
                @foreach($topPatients as $name => $data)
                    <tr>
                        <td>{{ $name }}</td>
                        <td>{{ $data['count'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($data['latest']->date_of_appointment)->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>
            <strong>Report Generated:</strong> {{ now()->format('F d, Y h:i A') }}<br>
            <strong>Generated By:</strong> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}<br>
            <strong>Rural Health Unit Gabaldon</strong> | Official Health Services Report<br>
            <em>This is a computer-generated report.</em>
        </p>
    </div>

    <script>
        // Auto-print when page loads (optional)
        window.onload = function() {
            // Uncomment the line below if you want automatic printing
            // window.print();
        }
    </script>
</body>
</html>
