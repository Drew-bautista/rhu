<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\DentalRecords;
use Illuminate\Http\Request;

class StaffDentalController extends Controller
{
    public function index()
    {
        $dentalRecords = DentalRecords::with('appointments')->get(); // Fetch all dental records
        return view('staff.dental-record.index', compact('dentalRecords'));
    }

    public function create()
    {
        $appointments = Appointment::all(); // Fetch all appointments for the dropdown
        return view('staff.dental-record.create', compact('appointments'));
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

        // Create the dental record
        DentalRecords::create([
            'appointment_id' => $request->appointment_id,
            'services' => $request->services,
            'tooth_area' => $request->tooth_area,
            'findings' => $request->findings,
            'prescription' => $request->prescription,
        ]);

        // Update the appointment status to completed and set service to Dental Assessment
        $appointment = Appointment::find($request->appointment_id);
        if ($appointment) {
            $updateData = [
                'status' => 'completed',
                'service' => 'Dental Assessment'
            ];
            
            // If the appointment doesn't have a date_of_appointment, set it to today
            if (!$appointment->date_of_appointment) {
                $updateData['date_of_appointment'] = now()->toDateString();
            }
            
            // If the appointment doesn't have a time, set it to current time
            if (!$appointment->time) {
                $updateData['time'] = now()->toTimeString();
            }
            
            $appointment->update($updateData);
        }

        return redirect()->route('staff.dental-record.index')->with('success', 'Dental record created successfully.');
    }

    public function show($id)
    {
        $dentalRecords = DentalRecords::with('appointments')->findOrFail($id);
        return view('staff.dental-record.show', compact('dentalRecords')); // Show all dental records
    }

    public function edit($id)
    {
        $dentalRecords = DentalRecords::findOrFail($id);
        $appointments = Appointment::all();
        return view('staff.dental-record.edit', compact('dentalRecords', 'appointments'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([

            'services' => 'nullable|string',
            'tooth_area' => 'nullable|string',
            'findings' => 'required|string',
            'prescription' => 'nullable|string',
        ]);

        $dentalRecords = DentalRecords::findOrFail($id);
        $dentalRecords->update([

            'services' => $request->services,
            'tooth_area' => $request->tooth_area,
            'findings' => $request->findings,
            'prescription' => $request->prescription,
        ]);

        return redirect()->route('staff.dental-record.index')->with('success', 'Dental record updated successfully.');
    }

    public function destroy($id)
    {
        $dentalRecords = DentalRecords::findOrFail($id);
        $dentalRecords->delete();
        return redirect()->route('staff.dental-record.index')->with('success', 'Dental record deleted successfully.');
    }
}
