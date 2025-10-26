<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Infirmary;
use App\Models\DentalRecords;
use App\Models\PrenatalRecords;
use App\Models\Tbdot;
use App\Models\Vaccine;
use App\Models\AnimalBiteCase;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::query();
        
        // Filter by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date_of_appointment', [$request->start_date, $request->end_date]);
        }

        // Filter by patient name
        if ($request->has('patient_name') && $request->patient_name) {
            $query->where('name', 'like', '%' . $request->patient_name . '%');
        }
        
        // Enhanced service filtering with multiple variations
        if ($request->filled('service')) {
            $this->applyServiceFilter($query, $request->service);
        }

        $appointments = $query->orderBy('date_of_appointment', 'desc')->paginate(20);
        
        // Get filtered statistics based on current filters
        $statisticsQuery = Appointment::query();
        
        // Apply same filters to statistics
        if ($request->has('start_date') && $request->has('end_date')) {
            $statisticsQuery->whereBetween('date_of_appointment', [$request->start_date, $request->end_date]);
        }
        if ($request->filled('patient_name')) {
            $statisticsQuery->where('name', 'like', '%' . $request->patient_name . '%');
        }
        if ($request->filled('service')) {
            $this->applyServiceFilter($statisticsQuery, $request->service);
        }
        
        $statistics = [
            'total_appointments' => $statisticsQuery->count(),
            'completed_appointments' => (clone $statisticsQuery)->where('status', 'completed')->count(),
            'pending_appointments' => (clone $statisticsQuery)->where('status', 'pending')->count(),
            'total_infirmary' => Infirmary::count(),
            'total_dental' => DentalRecords::count(),
            'total_prenatal' => PrenatalRecords::count(),
            'total_tbdots' => Tbdot::count(),
            'total_vaccines' => Vaccine::count(),
            'total_animal_bites' => AnimalBiteCase::count(),
        ];
        
        return view('admin.reports.index', compact('appointments', 'statistics'));
    }

    private function applyServiceFilter(Builder $query, string $service): void
    {
        $normalized = strtolower(trim($service));

        $serviceKeywords = [
            'general consultation' => [
                'general consultation',
                'consultation',
                'checkup',
                'check-up',
                'medical consultation',
                'health assessment',
                'physical exam',
                'physical examination',
            ],
            'prenatal' => [
                'prenatal',
                'pregnancy',
                'prenatal checkup',
                'prenatal check-up',
                'antenatal',
            ],
            'dental' => [
                'dental',
                'tooth',
                'oral health',
                'dentist',
                'dental care',
            ],
            'vaccination' => [
                'vaccination',
                'vaccine',
                'immunization',
                'immunisation',
                'inoculation',
            ],
            'laboratory' => [
                'laboratory',
                'lab',
                'test',
                'blood test',
                'cbc',
                'urinalysis',
                'hematology',
                'chemistry',
            ],
        ];

        $keywords = collect($serviceKeywords[$normalized] ?? [$normalized])
            ->map(fn ($term) => strtolower(trim($term)))
            ->filter()
            ->unique()
            ->values();

        if ($keywords->isEmpty()) {
            return;
        }

        $query->where(function (Builder $inner) use ($keywords) {
            $keywords->each(function (string $keyword, int $index) use ($inner) {
                $method = $index === 0 ? 'whereRaw' : 'orWhereRaw';
                $inner->{$method}('LOWER(service) LIKE ?', ['%' . $keyword . '%']);
            });
        });
    }

    public function patientHistory($patientName)
    {
        // Get all appointments for this patient
        $appointments = Appointment::where('name', $patientName)
            ->orderBy('date_of_appointment', 'desc')
            ->get();
        
        // Get all related records
        // Split the patient name to match against firstname and lastname in Infirmary
        $nameParts = explode(' ', $patientName);
        $firstName = $nameParts[0] ?? '';
        $lastName = end($nameParts) ?: '';
        
        $infirmaryRecords = Infirmary::where(function($q) use ($firstName, $lastName, $patientName) {
            // Try to match by full name or by first and last name
            $q->whereRaw("CONCAT(firstname, ' ', lastname) = ?", [$patientName])
              ->orWhere(function($q2) use ($firstName, $lastName) {
                  $q2->where('firstname', $firstName)
                     ->where('lastname', $lastName);
              });
        })->get();
        
        $dentalRecords = DentalRecords::whereHas('appointments', function($q) use ($patientName) {
            $q->where('name', $patientName);
        })->get();
        
        $prenatalRecords = PrenatalRecords::whereHas('appointments', function($q) use ($patientName) {
            $q->where('name', $patientName);
        })->get();
        
        $tbdotRecords = Tbdot::where('patient_name', $patientName)->get();
        
        $vaccineRecords = Vaccine::where('patient_name', $patientName)->get();
        
        $animalBiteRecords = AnimalBiteCase::whereHas('appointment', function($q) use ($patientName) {
            $q->where('name', $patientName);
        })->get();
        
        return view('admin.reports.patient-history', compact(
            'patientName',
            'appointments',
            'infirmaryRecords',
            'dentalRecords',
            'prenatalRecords',
            'tbdotRecords',
            'vaccineRecords',
            'animalBiteRecords'
        ));
    }

    public function generateMonthlyReport($month, $year)
    {
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();
        
        $data = [
            'appointments' => Appointment::whereBetween('date_of_appointment', [$startDate, $endDate])->get(),
            'infirmary' => Infirmary::whereBetween('created_at', [$startDate, $endDate])->get(),
            'dental' => DentalRecords::whereBetween('created_at', [$startDate, $endDate])->get(),
            'prenatal' => PrenatalRecords::whereBetween('created_at', [$startDate, $endDate])->get(),
            'tbdots' => Tbdot::whereBetween('created_at', [$startDate, $endDate])->get(),
            'vaccines' => Vaccine::whereBetween('date_administered', [$startDate, $endDate])->get(),
            'animal_bites' => AnimalBiteCase::whereBetween('date_of_incident', [$startDate, $endDate])->get(),
        ];
        
        return view('admin.reports.monthly', compact('data', 'month', 'year'));
    }

    public function exportReport(Request $request)
    {
        // This can be extended to export to PDF or Excel
        // For now, we'll just return a printable view
        
        $query = Appointment::query();
        
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date_of_appointment', [$request->start_date, $request->end_date]);
        }
        
        $appointments = $query->get();
        
        return view('admin.reports.export', compact('appointments'));
    }
}
