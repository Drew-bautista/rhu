<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Vaccine;
use Illuminate\Http\Request;

class StaffVaccineController extends Controller
{
    public function index()
    {
        $vaccines = Vaccine::with('appointment')->latest()->get();
        return view('staff.vaccines.index', compact('vaccines'));
    }

    public function create()
    {
        $appointments = Appointment::where('status', 'pending')->get();
        return view('staff.vaccines.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'nullable|exists:appointments,id',
            'patient_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer',
            'age_group' => 'required|in:infant,child,adolescent,adult,senior',
            'sex' => 'required|in:male,female,other',
            'contact_number' => 'required|string',
            'address' => 'required|string',
            'vaccine_type' => 'required|string',
            'dose_number' => 'required|string',
            'date_administered' => 'required|date',
            'next_dose_date' => 'nullable|date|after:date_administered',
            'administered_by' => 'required|string',
            'batch_number' => 'nullable|string',
            'expiry_date' => 'nullable|date',
            'adverse_reactions' => 'nullable|string',
            'remarks' => 'nullable|string'
        ]);

        Vaccine::create($validated);

        return redirect()->route('staff.vaccines.index')
            ->with('success', 'Vaccine record created successfully.');
    }

    public function show(Vaccine $vaccine)
    {
        return view('staff.vaccines.show', compact('vaccine'));
    }

    public function edit(Vaccine $vaccine)
    {
        $appointments = Appointment::all();
        return view('staff.vaccines.edit', compact('vaccine', 'appointments'));
    }

    public function update(Request $request, Vaccine $vaccine)
    {
        $validated = $request->validate([
            'appointment_id' => 'nullable|exists:appointments,id',
            'patient_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer',
            'age_group' => 'required|in:infant,child,adolescent,adult,senior',
            'sex' => 'required|in:male,female,other',
            'contact_number' => 'required|string',
            'address' => 'required|string',
            'vaccine_type' => 'required|string',
            'dose_number' => 'required|string',
            'date_administered' => 'required|date',
            'next_dose_date' => 'nullable|date|after:date_administered',
            'administered_by' => 'required|string',
            'batch_number' => 'nullable|string',
            'expiry_date' => 'nullable|date',
            'adverse_reactions' => 'nullable|string',
            'remarks' => 'nullable|string'
        ]);

        $vaccine->update($validated);

        return redirect()->route('staff.vaccines.index')
            ->with('success', 'Vaccine record updated successfully.');
    }

    public function destroy(Vaccine $vaccine)
    {
        $vaccine->delete();
        return redirect()->route('staff.vaccines.index')
            ->with('success', 'Vaccine record deleted successfully.');
    }
}
