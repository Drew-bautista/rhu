<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\Inventory;
use App\Models\Appointment;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with(['inventory', 'appointment', 'prescribedBy', 'dispensedBy'])
            ->latest()
            ->paginate(20);
        
        return view('admin.prescriptions.index', compact('prescriptions'));
    }

    public function show(Prescription $prescription)
    {
        $prescription->load(['inventory', 'appointment', 'prescribedBy', 'dispensedBy']);
        return view('admin.prescriptions.show', compact('prescription'));
    }

    public function pending()
    {
        $prescriptions = Prescription::with(['inventory', 'appointment', 'prescribedBy'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(20);
        
        return view('admin.prescriptions.pending', compact('prescriptions'));
    }

    public function dispense(Request $request, Prescription $prescription)
    {
        $request->validate([
            'dispensed_notes' => 'nullable|string|max:500'
        ]);

        // Check if there's enough stock
        if ($prescription->inventory->quantity_in_stock < $prescription->quantity_prescribed) {
            return redirect()->back()
                ->with('error', 'Insufficient stock to dispense this prescription.');
        }

        // Update prescription status
        $prescription->update([
            'status' => 'dispensed',
            'dispensed_at' => now(),
            'dispensed_by' => auth()->id(),
            'special_instructions' => $request->dispensed_notes
        ]);

        // Update inventory stock
        $prescription->inventory->decrement('quantity_in_stock', $prescription->quantity_prescribed);

        return redirect()->back()
            ->with('success', 'Prescription dispensed successfully.');
    }

    public function cancel(Prescription $prescription)
    {
        if ($prescription->status == 'dispensed') {
            return redirect()->back()
                ->with('error', 'Cannot cancel a dispensed prescription.');
        }

        $prescription->update(['status' => 'cancelled']);

        return redirect()->back()
            ->with('success', 'Prescription cancelled successfully.');
    }

    public function patientHistory($patientName)
    {
        $prescriptions = Prescription::with(['inventory', 'appointment', 'prescribedBy', 'dispensedBy'])
            ->where('patient_name', 'like', '%' . $patientName . '%')
            ->latest()
            ->paginate(20);
        
        return view('admin.prescriptions.patient-history', compact('prescriptions', 'patientName'));
    }
}
