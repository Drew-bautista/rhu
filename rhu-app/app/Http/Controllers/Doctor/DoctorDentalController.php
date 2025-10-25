<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\DentalRecords;
use Illuminate\Http\Request;

class DoctorDentalController extends Controller
{
    public function index()
    {
        $dentalRecords = DentalRecords::with('appointments')->latest()->get(); // Fetch all dental records
        return view('admin.dental-record.index', compact('dentalRecords'));
    }

    public function create()
    {
        $appointments = Appointment::all(); // Fetch all appointments for the dropdown
        return view('admin.dental-record.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'services' => 'nullable|string',
            'tooth_area' => 'nullable|string',
            'findings' => 'required|string',
            'prescription' => 'nullable|string',
        ]);

        DentalRecords::create([
            'appointment_id' => $request->appointment_id,
            'services' => $request->services,
            'tooth_area' => $request->tooth_area,
            'findings' => $request->findings,
            'prescription' => $request->prescription,
        ]);

        return redirect()->route('admin.dental-record.index')->with('success', 'Dental record created successfully.');
    }

    public function show($id)
    {
        $dentalRecords = DentalRecords::with('appointments')->findOrFail($id);
        return view('admin.dental-record.show', compact('dentalRecords')); // Show all dental records
    }

    public function edit($id)
    {
        $dentalRecords = DentalRecords::findOrFail($id);
        $appointments = Appointment::all();
        return view('admin.dental-record.edit', compact('dentalRecords', 'appointments'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'services' => 'nullable|string',
            'tooth_area' => 'nullable|string',
            'findings' => 'required|string',
            'prescription' => 'nullable|string',
        ]);

        $dentalRecords = DentalRecords::findOrFail($id);
        $dentalRecords->update([
            'appointment_id' => $request->appointment_id,
            'services' => $request->services,
            'tooth_area' => $request->tooth_area,
            'findings' => $request->findings,
            'prescription' => $request->prescription,
        ]);

        return redirect()->route('admin.dental-record.show', $id)->with('success', 'Dental record updated successfully.');
    }

    public function destroy($id)
    {
        $dentalRecords = DentalRecords::findOrFail($id);
        $dentalRecords->delete();
        return redirect()->route('admin.dental-record.index')->with('success', 'Dental record deleted successfully.');
    }
}
