<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Infirmary;
use Illuminate\Http\Request;

class StaffInfirmaryController extends Controller
{
    public function index()
    {
        $infirmary = Infirmary::all();
        return view('staff.infirmary.index', compact('infirmary'));
    }

    public function create()
    {
        return view('staff.infirmary.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'sex' => 'required|in:male,female',
            'birthdate' => 'required|date',
            'contact_no' => 'required|string|max:20',
            'emergency_contact' => 'required|digits:11',
            'height' => 'required|numeric|between:0,999.99',
            'weight' => 'required|numeric|between:0,999.99',
            'blood_pressure' => 'required|string|max:20',
            'heart_rate' => 'required|numeric',
            'respiratory_rate' => 'required|numeric',
            'visual_acuity' => 'required|string|max:20',
            'temperature' => 'required|numeric',
            'consultation_date_time' => 'required|date',
            'chief_complaint' => 'nullable|string|max:255',
            'laboratory_findings' => 'nullable|string|max:255',
            'assessment_diagnosis' => 'nullable|string|max:255',
            'medical_history' => 'nullable|string|max:255',
            'medication_treatment' => 'nullable|string|max:255',
            'personal_social_history' => 'nullable|string|max:255',
            'pregnancy_history' => 'nullable|string|max:255',
        ]);
        Infirmary::create($validatedData);

        return redirect()->route('staff.infirmary.index')->with('success', 'Data created successfully.');
    }

    public function show($id)
    {

        $infirmary = Infirmary::findOrFail($id);
        return view('staff.infirmary.show', compact('infirmary')); // Placeholder, implement as needed
    }

    public function edit($id)
    {
        $infirmary = Infirmary::findOrFail($id);
        return view('staff.infirmary.edit', compact('infirmary'));
    }

    public function update(Request $request, $id)
    {
        $infirmary = Infirmary::findOrFail($id);

        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'sex' => 'required|in:male,female',
            'birthdate' => 'required|date',
            'contact_no' => 'required|string|max:20',
            'emergency_contact' => 'required|digits:11',
            'height' => 'required|numeric|between:0,999.99',
            'weight' => 'required|numeric|between:0,999.99',
            'blood_pressure' => 'required|string|max:20',
            'heart_rate' => 'required|numeric',
            'respiratory_rate' => 'required|numeric',
            'visual_acuity' => 'required|string|max:20',
            'temperature' => 'required|numeric',
            'consultation_date_time' => 'required|date',
            'chief_complaint' => 'nullable|string|max:255',
            'laboratory_findings' => 'nullable|string|max:255',
            'assessment_diagnosis' => 'nullable|string|max:255',
            'medical_history' => 'nullable|string|max:255',
            'medication_treatment' => 'nullable|string|max:255',
            'personal_social_history' => 'nullable|string|max:255',
            'pregnancy_history' => 'nullable|string|max:255',
        ]);
        $infirmary->update($validatedData);
        return redirect()->route('staff.infirmary.index')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        $infirmary = Infirmary::findOrFail($id);
        $infirmary->delete();
        return redirect()->route('staff.infirmary.index')->with('success', 'Data deleted successfully.');
    }
}
