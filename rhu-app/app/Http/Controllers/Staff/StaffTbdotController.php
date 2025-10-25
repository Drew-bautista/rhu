<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Tbdot;
use Illuminate\Http\Request;

class StaffTbdotController extends Controller
{
    public function index()
    {
        try {
            $tbdots = Tbdot::with('appointment')->latest()->get();
            
            // Debug: Log the first record to check fields
            if ($tbdots->count() > 0) {
                \Log::info('Staff TBdots - First record:', [
                    'patient_name' => $tbdots->first()->patient_name,
                    'treatment_status' => $tbdots->first()->treatment_status,
                    'treatment_category' => $tbdots->first()->treatment_category,
                    'tb_type' => $tbdots->first()->tb_type,
                ]);
            }
            
            return view('staff.tbdots.index', compact('tbdots'));
        } catch (\Exception $e) {
            \Log::error('TB-DOTS Index Error: ' . $e->getMessage());
            return view('staff.tbdots.index', ['tbdots' => collect()]);
        }
    }

    public function create()
    {
        $appointments = Appointment::where('status', 'pending')->get();
        return view('staff.tbdots.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'nullable|exists:appointments,id',
            'patient_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer',
            'sex' => 'required|in:male,female,other',
            'contact_number' => 'required|string',
            'address' => 'required|string',
            'date_of_diagnosis' => 'required|date',
            'tb_type' => 'required|in:pulmonary,extra_pulmonary',
            'treatment_category' => 'required|in:category_1,category_2,category_3',
            'treatment_start_date' => 'required|date',
            'treatment_end_date' => 'nullable|date|after:treatment_start_date',
            'treatment_status' => 'required|in:ongoing,completed,defaulted,failed,died,transferred_out',
            'remarks' => 'nullable|string'
        ]);

        Tbdot::create($validated);

        return redirect()->route('staff.tbdots.index')
            ->with('success', 'TB-DOTS record created successfully.');
    }

    public function show(Tbdot $tbdot)
    {
        return view('staff.tbdots.show', compact('tbdot'));
    }

    public function edit(Tbdot $tbdot)
    {
        try {
            $appointments = Appointment::all();
            return view('staff.tbdots.edit', compact('tbdot', 'appointments'));
        } catch (\Exception $e) {
            \Log::error('TB-DOTS Edit Error: ' . $e->getMessage());
            return redirect()->route('staff.tbdots.index')
                ->with('error', 'Unable to load edit form. Please try again.');
        }
    }

    public function update(Request $request, Tbdot $tbdot)
    {
        $validated = $request->validate([
            'appointment_id' => 'nullable|exists:appointments,id',
            'patient_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer',
            'sex' => 'required|in:male,female,other',
            'contact_number' => 'required|string',
            'address' => 'required|string',
            'date_of_diagnosis' => 'required|date',
            'tb_type' => 'required|in:pulmonary,extra_pulmonary',
            'treatment_category' => 'required|in:category_1,category_2,category_3',
            'treatment_start_date' => 'required|date',
            'treatment_end_date' => 'nullable|date|after:treatment_start_date',
            'treatment_status' => 'required|in:ongoing,completed,defaulted,failed,died,transferred_out',
            'remarks' => 'nullable|string'
        ]);

        $tbdot->update($validated);

        return redirect()->route('staff.tbdots.index')
            ->with('success', 'TB-DOTS record updated successfully.');
    }

    public function destroy(Tbdot $tbdot)
    {
        $tbdot->delete();
        return redirect()->route('staff.tbdots.index')
            ->with('success', 'TB-DOTS record deleted successfully.');
    }
}
