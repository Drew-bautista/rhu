<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\CBC_Results;
use Illuminate\Http\Request;

class CBCresultsController extends Controller
{
    public function index()
    {
        $cbcResults = CBC_Results::with('appointments')->latest()->get();
        return view('admin.cbc-results.index', compact('cbcResults'));
    }

    public function create()
    {
        // Only get appointments with CBC/laboratory-related services
        $appointments = Appointment::where(function($query) {
            $query->where('service', 'LIKE', '%cbc%')
                  ->orWhere('service', 'LIKE', '%blood%')
                  ->orWhere('service', 'LIKE', '%laboratory%')
                  ->orWhere('service', 'LIKE', '%lab%')
                  ->orWhere('service', '=', 'CBC')
                  ->orWhere('service', '=', 'Blood Test')
                  ->orWhere('service', '=', 'Laboratory')
                  ->orWhere('service', '=', 'Complete Blood Count');
        })->get();
        return view('admin.cbc-results.create', compact('appointments'));
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
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('admin.cbc-results.index')->with('success', 'CBC Results created successfully.');
    }

    public function show($id)
    {
        $cbcResult = CBC_Results::with('appointments')->findOrFail($id);
        return view('admin.cbc-results.show', compact('cbcResult'));
    }

    public function edit($id)
    {
        $cbcResult = CBC_Results::findOrFail($id);
        // Only get appointments with CBC/laboratory-related services
        $appointments = Appointment::where(function($query) {
            $query->where('service', 'LIKE', '%cbc%')
                  ->orWhere('service', 'LIKE', '%blood%')
                  ->orWhere('service', 'LIKE', '%laboratory%')
                  ->orWhere('service', 'LIKE', '%lab%')
                  ->orWhere('service', '=', 'CBC')
                  ->orWhere('service', '=', 'Blood Test')
                  ->orWhere('service', '=', 'Laboratory')
                  ->orWhere('service', '=', 'Complete Blood Count');
        })->get();
        return view('admin.cbc-results.edit', compact('cbcResult', 'appointments'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'hemoglobin' => 'required|numeric|min:0|max:30',
                'hematocrit' => 'required|numeric|min:0|max:100',
                'rbc_count' => 'required|numeric|min:0|max:10',
                'wbc_count' => 'required|numeric|min:0|max:50',
                'platelet_count' => 'required|numeric|min:0|max:1000',
                'mcv' => 'nullable|numeric|min:0|max:150',
                'mch' => 'nullable|numeric|min:0|max:50',
                'mchc' => 'nullable|numeric|min:0|max:50',
                'neutrophils' => 'nullable|numeric|min:0|max:100',
                'lymphocytes' => 'nullable|numeric|min:0|max:100',
                'monocytes' => 'nullable|numeric|min:0|max:100',
                'eosinophils' => 'nullable|numeric|min:0|max:100',
                'basophils' => 'nullable|numeric|min:0|max:100',
                'remarks' => 'nullable|string|max:255',
            ]);

            $cbcResult = CBC_Results::findOrFail($id);
            
            // Update the appointment name if it exists
            if ($cbcResult->appointments) {
                $cbcResult->appointments->update(['name' => $validatedData['name']]);
            }
            
            // Update CBC results (excluding name as it's handled above)
            unset($validatedData['name']);
            $cbcResult->update($validatedData);

            return redirect()->route('admin.cbc-results.index')->with('success', 'CBC Results updated successfully.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating CBC Results: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $cbcResult = CBC_Results::findOrFail($id);
        $cbcResult->delete();

        return redirect()->route('admin.cbc-results.index')->with('success', 'CBC Results deleted successfully.');
    }
}
