<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\HealthAssessment;
use App\Models\Patients;
use App\Models\Treatment;
use Illuminate\Http\Request;

class StaffTreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::with('patient', 'health_assessment')->get();
        return view('staff.treatment.index')->with('treatments', $treatments);
    }

    public function show($id)
    {
        $treatment = Treatment::with('patient', 'health_assessment')->findOrFail($id);
        return view('staff.treatment.show')->with('treatment', $treatment);
    }
    public function getHealthAssessment($patientId)
    {
        $healthAssessment = HealthAssessment::where('patient_id', $patientId)->first();
        return response()->json(['health_assessment_id' => $healthAssessment->id]);
    }
    public function create()
    {
        $patients = Patients::all();
        $healthAssessments = HealthAssessment::all();
        return view('admin.treatment.create')->with('patients', $patients)->with('healthAssessments', $healthAssessments);
    }
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'consultation_date_time' => 'required|date',
            'chief_complaint' => 'nullable|string',
            'laboratory_findings' => 'nullable|string',
            'assessment_diagnosis' => 'nullable|string',
            'medical_history' => 'nullable|string',
            'medication_treatment' => 'nullable|string',
            'personal_social_history' => 'nullable|string',
            'pregnancy_history' => 'nullable|string',
        ]);

        // Create a new Treatment record
        Treatment::create([
            'patient_id' => $request->input('patient_id'),
            'consultation_date_time' => $request->input('consultation_date_time'),
            'chief_complaint' => $request->input('chief_complaint'),
            'laboratory_findings' => $request->input('laboratory_findings'),
            'assessment_diagnosis' => $request->input('assessment_diagnosis'),
            'medical_history' => $request->input('medical_history'),
            'medication_treatment' => $request->input('medication_treatment'),
            'personal_social_history' => $request->input('personal_social_history'),
            'pregnancy_history' => $request->input('pregnancy_history'),
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.treatment.index')->with('success', 'Treatment created successfully!');
    }



    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'health_assessment_id' => 'required|exists:health_assessments,id',
            'consultation_date_time' => 'required|date',
            'chief_complaint' => 'required|string',
            'laboratory_findings' => 'nullable|string',
            'assessment_diagnosis' => 'nullable|string',
            'medical_history' => 'nullable|string',
            'medication_treatment' => 'nullable|string',
            'personal_social_history' => 'nullable|string',
            'pregnancy_history' => 'nullable|string',
        ]);

        $treatment = Treatment::findOrFail($id);
        $treatment->update($validatedData);

        return redirect()->route('admin.treatment.index')->with('success', 'Treatment record updated successfully.');
    }

    public function destroy($id)
    {
        $treatment = Treatment::findOrFail($id);
        $treatment->delete();

        return redirect()->route('admin.treatment.index')->with('success', 'Treatment record deleted successfully.');
    }
}
