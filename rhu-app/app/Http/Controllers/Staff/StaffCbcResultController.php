<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\CBC_Results;
use Illuminate\Http\Request;

class StaffCbcResultController extends Controller
{
    public function index()
    {
        $cbcResults = CBC_Results::with('appointments')->get();
        return view('staff.cbc-results.index', compact('cbcResults'));
    }

    public function create()
    {
        $appointments = Appointment::all(); // Assuming you want to list all appointments for selection
        return view('staff.cbc-results.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'hemoglobin' => 'nullable|numeric',
            'hematocrit' => 'nullable|numeric',
            'rbc_count' => 'nullable|numeric',
            'wbc_count' => 'nullable|numeric',
            'platelet_count' => 'nullable|numeric',
            'mcv' => 'nullable|numeric',
            'mch' => 'nullable|numeric',
            'mchc' => 'nullable|numeric',
            'neutrophils' => 'nullable|numeric',
            'lymphocytes' => 'nullable|numeric',
            'monocytes' => 'nullable|numeric',
            'eosinophils' => 'nullable|numeric',
            'basophils' => 'nullable|numeric',
            'newborn_screening' => 'nullable|string|max:255',
            'hepa_b_screening' => 'nullable|string|max:255',
            'fasting_blood_sugar' => 'nullable|numeric',
            'cholesterol' => 'nullable|numeric',
            'remarks' => 'nullable|string|max:255',
        ]);
        CBC_Results::create([
            'appointment_id' => $request->appointment_id,
            'hemoglobin' => $request->hemoglobin,
            'hematocrit' => $request->hematocrit,
            'rbc_count' => $request->rbc_count,
            'wbc_count' => $request->wbc_count,
            'platelet_count' => $request->platelet_count,
            'mcv' => $request->mcv,
            'mch' => $request->mch,
            'mchc' => $request->mchc,
            'neutrophils' => $request->neutrophils,
            'lymphocytes' => $request->lymphocytes,
            'monocytes' => $request->monocytes,
            'eosinophils' => $request->eosinophils,
            'basophils' => $request->basophils,
            'newborn_screening' => $request->newborn_screening,
            'hepa_b_screening' => $request->hepa_b_screening,
            'fasting_blood_sugar' => $request->fasting_blood_sugar,
            'cholesterol' => $request->cholesterol,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('staff.cbc-results.index')->with('success', 'CBC Results created successfully.');
    }

    public function show($id)
    {
        $cbcResult = CBC_Results::with('appointments')->findOrFail($id);
        return view('staff.cbc-results.show', compact('cbcResult'));
    }

    public function edit($id)
    {
        $cbcResult = CBC_Results::findOrFail($id);
        $appointments = Appointment::all();
        return view('staff.cbc-results.edit', compact('cbcResult', 'appointments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'hemoglobin' => 'nullable|numeric',
            'hematocrit' => 'nullable|numeric',
            'rbc_count' => 'nullable|numeric',
            'wbc_count' => 'nullable|numeric',
            'platelet_count' => 'nullable|numeric',
            'mcv' => 'nullable|numeric',
            'mch' => 'nullable|numeric',
            'mchc' => 'nullable|numeric',
            'neutrophils' => 'nullable|numeric',
            'lymphocytes' => 'nullable|numeric',
            'monocytes' => 'nullable|numeric',
            'eosinophils' => 'nullable|numeric',
            'basophils' => 'nullable|numeric',
            'newborn_screening' => 'nullable|string|max:255',
            'hepa_b_screening' => 'nullable|string|max:255',
            'fasting_blood_sugar' => 'nullable|numeric',
            'cholesterol' => 'nullable|numeric',
            'remarks' => 'nullable|string|max:255',
        ]);

        $cbcResult = CBC_Results::findOrFail($id);
        $cbcResult->update([

            'hemoglobin' => $request->hemoglobin,
            'hematocrit' => $request->hematocrit,
            'rbc_count' => $request->rbc_count,
            'wbc_count' => $request->wbc_count,
            'platelet_count' => $request->platelet_count,
            'mcv' => $request->mcv,
            'mch' => $request->mch,
            'mchc' => $request->mchc,
            'neutrophils' => $request->neutrophils,
            'lymphocytes' => $request->lymphocytes,
            'monocytes' => $request->monocytes,
            'eosinophils' => $request->eosinophils,
            'basophils' => $request->basophils,
            'newborn_screening' => $request->newborn_screening,
            'hepa_b_screening' => $request->hepa_b_screening,
            'fasting_blood_sugar' => $request->fasting_blood_sugar,
            'cholesterol' => $request->cholesterol,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('staff.cbc-results.index')->with('success', 'CBC Results updated successfully.');
    }

    public function destroy($id)
    {
        $cbcResult = CBC_Results::findOrFail($id);
        $cbcResult->delete();

        return redirect()->route('staff.cbc-results.index')->with('success', 'CBC Results deleted successfully.');
    }
}
