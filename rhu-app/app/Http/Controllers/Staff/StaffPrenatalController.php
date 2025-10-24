<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patients;
use App\Models\PrenatalRecords;
use Illuminate\Http\Request;

class StaffPrenatalController extends Controller
{
    public function index()
    {
        $prenatalRecords = PrenatalRecords::with('appointments')->latest()->get();
        return view('staff.prenatal-record.index')->with('prenatalRecords', $prenatalRecords); // Fetch prenatal records logic here

    }
    public function create()
    {
        $appointments = Appointment::all();
        return view('staff.prenatal-record.create', compact('appointments')); // Return view for creating a new prenatal record
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'age_of_gestation' => 'required|integer',
            'blood_pressure' => ['required', 'string', 'max:20', 'regex:/^\d{2,3}\/\d{2,3}$/'],
            'nutritional_status' => 'required|in:normal,underweight,overweight',
            'birth_plan' => 'nullable|string',
            'dental_checkup' => 'nullable|string',
        ], [
            'blood_pressure.regex' => 'Blood pressure must be in the format XXX/XXX (e.g., 120/80)',
        ]);

        PrenatalRecords::create([
            'appointment_id' => $request->appointment_id,
            'weight' => $request->weight,
            'height' => $request->height,
            'age_of_gestation' => $request->age_of_gestation,
            'blood_pressure' => $request->blood_pressure,
            'nutritional_status' => $request->nutritional_status,
            'birth_plan' => $request->birth_plan,
            'dental_checkup' => $request->dental_checkup,
        ]);

        return redirect()->route('staff.prenatal-record.index')->with('success', 'Prenatal record created successfully.');
    }

    public function show($id)
    {
        $prenatalRecord = PrenatalRecords::with('appointments')->findOrFail($id);
        return view('staff.prenatal-record.show', compact('prenatalRecord')); // Show specific prenatal record
    }

    public function edit($id)
    {
        $prenatalRecord = PrenatalRecords::findOrFail($id);
        $appointments = Appointment::all();
        return view('staff.prenatal-record.edit', compact('prenatalRecord', 'appointments')); // Return view for editing a prenatal record
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'weight' => 'required|numeric',
                'height' => 'required|numeric',
                'age_of_gestation' => 'required|integer',
                'blood_pressure' => ['required', 'string', 'max:20', 'regex:/^\d{2,3}\/\d{2,3}$/'],
                'nutritional_status' => 'required|in:normal,underweight,overweight',
                'service' => 'nullable|string|max:255',
                'dental_checkup' => 'nullable|string|max:255',
            ], [
                'blood_pressure.regex' => 'Blood pressure must be in the format XXX/XXX (e.g., 120/80)',
            ]);

            $prenatalRecord = PrenatalRecords::findOrFail($id);
            
            // Update the appointment name if it exists
            if ($prenatalRecord->appointments) {
                $prenatalRecord->appointments->update(['name' => $validatedData['name']]);
            }
            
            // Update prenatal record (excluding name as it's handled above)
            $prenatalData = $validatedData;
            unset($prenatalData['name']);
            $prenatalData['birth_plan'] = $validatedData['service']; // Map service to birth_plan
            unset($prenatalData['service']);
            
            $prenatalRecord->update($prenatalData);

            return redirect()->route('staff.prenatal-record.index')->with('success', 'Prenatal record updated successfully.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating record: ' . $e->getMessage())->withInput();
        }
    }
    public function destroy($id)
    {
        $prenatalRecord = PrenatalRecords::findOrFail($id);
        $prenatalRecord->delete();

        return redirect()->route('staff.prenatal-record.index')->with('success', 'Prenatal record deleted successfully.');
    }
}
