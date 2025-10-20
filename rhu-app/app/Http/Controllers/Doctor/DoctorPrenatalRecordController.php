<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patients;
use App\Models\PrenatalRecords;
use Illuminate\Http\Request;

class DoctorPrenatalRecordController extends Controller
{
    public function index()
    {
        $prenatalRecords = PrenatalRecords::with('appointments')->latest()->get();
        return view('admin.prenatal-record.index')->with('prenatalRecords', $prenatalRecords); // Fetch prenatal records logic here

    }
    public function create()
    {
        $appointments = Appointment::all();
        return view('admin.prenatal-record.create', compact('appointments')); // Return view for creating a new prenatal record
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'age_of_gestation' => 'required|integer',
            'blood_pressure' => 'required|string|regex:/^\d{2,3}\/\d{2,3}$/',
            'nutritional_status' => 'required|in:normal,underweight,overweight',
            'birth_plan' => 'nullable|string',
            'dental_checkup' => 'nullable|string',
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

        return redirect()->route('admin.prenatal-record.index')->with('success', 'Prenatal record created successfully.');
    }

    public function show($id)
    {
        $prenatalRecord = PrenatalRecords::with('appointments')->findOrFail($id);
        return view('admin.prenatal-record.show', compact('prenatalRecord')); // Show specific prenatal record
    }

    public function edit($id)
    {
        $prenatalRecord = PrenatalRecords::findOrFail($id);
        $appointments = Appointment::all();
        return view('admin.prenatal-record.edit', compact('prenatalRecord', 'appointments')); // Return view for editing a prenatal record
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'service' => 'required|string',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'age_of_gestation' => 'required|integer',
            'blood_pressure' => 'required|string|regex:/^\d{2,3}\/\d{2,3}$/',
            'nutritional_status' => 'required|in:normal,underweight,overweight',
            'birth_plan' => 'nullable|string',
            'dental_checkup' => 'nullable|string',
        ]);

        $prenatalRecord = PrenatalRecords::findOrFail($id);
        
        // Update prenatal record
        $prenatalRecord->update([
            'appointment_id' => $request->appointment_id,
            'weight' => $request->weight,
            'height' => $request->height,
            'age_of_gestation' => $request->age_of_gestation,
            'blood_pressure' => $request->blood_pressure,
            'nutritional_status' => $request->nutritional_status,
            'birth_plan' => $request->birth_plan,
            'dental_checkup' => $request->dental_checkup,
        ]);

        // Update appointment service if needed
        if ($prenatalRecord->appointments) {
            $prenatalRecord->appointments->update(['service' => $request->service]);
        }

        return redirect()->route('admin.prenatal-record.index')->with('success', 'Prenatal record updated successfully.');
    }
    public function destroy($id)
    {
        $prenatalRecord = PrenatalRecords::findOrFail($id);
        $prenatalRecord->delete();

        return redirect()->route('admin.prenatal-record.index')->with('success', 'Prenatal record deleted successfully.');
    }
}
