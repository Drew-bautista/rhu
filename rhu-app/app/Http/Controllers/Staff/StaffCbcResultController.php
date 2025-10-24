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
        $cbcResults = CBC_Results::with('appointments')->latest()->get();
        return view('staff.cbc-results.index', compact('cbcResults'));
    }

    public function create()
    {
        $appointments = Appointment::all(); // Assuming you want to list all appointments for selection
        return view('staff.cbc-results.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
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
                'remarks' => 'nullable|string|max:255',
            ]);

            // Check if appointment service is CBC
            $appointment = Appointment::findOrFail($validatedData['appointment_id']);
            if (strtolower($appointment->service) !== 'cbc') {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Warning: This appointment is for '{$appointment->service}' service, not CBC. Please select the correct appointment or create the appropriate lab result.");
            }

            CBC_Results::create($validatedData);

            return redirect()->route('staff.cbc-results.index')->with('success', 'CBC Results created successfully.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating CBC result: ' . $e->getMessage())->withInput();
        }
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
        try {
            $validatedData = $request->validate([
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
                'remarks' => 'nullable|string|max:255',
            ]);

            $cbcResult = CBC_Results::with('appointments')->findOrFail($id);
            
            // Show warning if service is not CBC (but still allow update)
            if ($cbcResult->appointments && strtolower($cbcResult->appointments->service) !== 'cbc') {
                $cbcResult->update($validatedData);
                return redirect()->route('staff.cbc-results.index')
                    ->with('warning', "CBC Results updated successfully. Note: This appointment was for '{$cbcResult->appointments->service}' service, not CBC.");
            }

            $cbcResult->update($validatedData);
            return redirect()->route('staff.cbc-results.index')->with('success', 'CBC Results updated successfully.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating CBC result: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $cbcResult = CBC_Results::findOrFail($id);
        $cbcResult->delete();

        return redirect()->route('staff.cbc-results.index')->with('success', 'CBC Results deleted successfully.');
    }
}
