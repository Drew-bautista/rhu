<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\HealthAssessment;
use App\Models\Patients;
use App\Models\User;
use Illuminate\Http\Request;

class StaffHealthRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all health assessments with patient details
        $healthAssessments = HealthAssessment::with('patient')->get();
        return view('staff.health-record.index', compact('healthAssessments'));
    }

    /**
     * Show the form for creating a new health assessment.
     */
    public function create()
    {
        // Fetch all patients for the dropdown
        $patients = Patients::all();
        return view('admin.health-record.create', compact('patients'));
    }

    /**
     * Store a newly created health assessment in the database.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'height' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'blood_pressure' => 'nullable|string|max:255',
            'heart_rate' => 'nullable|string|max:255',
            'respiratory_rate' => 'nullable|string|max:255',
            'visual_acuity' => 'nullable|string|max:255',
            'temperature' => 'nullable|string|max:255',
            // 'medical_conditions' => 'nullable|string',
            // 'medical_history' => 'nullable|string',
            // 'symptoms' => 'nullable|string',
            // 'allergies' => 'nullable|string',
        ]);

        // Create a new HealthAssessment record
        HealthAssessment::create($request->all());

        // Redirect back with a success message
        return redirect()->route('admin.health-record.index')->with('success', 'Health assessment created successfully!');
    }


    public function show($id)
    {

        // Fetch the health assessment by ID with patient details
        $healthAssessment = HealthAssessment::with('patient')->findOrFail($id);

        // Pass the data to the view
        return view('staff.health-record.show', compact('healthAssessment'));
    }
    /**
     * Show the form for editing the specified health assessment.
     */
    public function edit($id)
    {
        // Fetch the health assessment by ID
        $healthAssessment = HealthAssessment::findOrFail($id);
        $patients = Patients::all();
        return view('admin.health-record.edit', compact('healthAssessment', 'patients'));
    }

    /**
     * Update the specified health assessment in the database.
     */
    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'height' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'blood_pressure' => 'nullable|string|max:255',
            'heart_rate' => 'nullable|string|max:255',
            'medical_conditions' => 'nullable|string',
            'medical_history' => 'nullable|string',
            'symptoms' => 'nullable|string',
            'allergies' => 'nullable|string',
        ]);

        // Find the health assessment by ID and update it
        $healthAssessment = HealthAssessment::findOrFail($id);
        $healthAssessment->update($request->all());

        // Redirect back with a success message
        return redirect()->route('admin.health-record.index')->with('success', 'Health assessment updated successfully!');
    }

    /**
     * Remove the specified health assessment from the database.
     */
    public function destroy($id)
    {
        // Find the health assessment by ID and delete it
        $healthAssessment = HealthAssessment::findOrFail($id);
        $healthAssessment->delete();

        // Redirect back with a success message
        return redirect()->route('admin.health-record.index')->with('success', 'Health assessment deleted successfully!');
    }
}
