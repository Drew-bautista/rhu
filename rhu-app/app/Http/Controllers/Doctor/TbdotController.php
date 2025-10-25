<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Tbdot;
use App\Models\Appointment;
use Illuminate\Http\Request;

class TbdotController extends Controller
{
    public function index()
    {
        $tbdots = Tbdot::with('appointment')->latest()->get();
        
        // Debug: Log the first record to check fields
        if ($tbdots->count() > 0) {
            \Log::info('Doctor TBdots - First record:', [
                'patient_name' => $tbdots->first()->patient_name,
                'treatment_status' => $tbdots->first()->treatment_status,
                'treatment_category' => $tbdots->first()->treatment_category,
                'tb_type' => $tbdots->first()->tb_type,
            ]);
        }
        
        \Log::info('Doctor TBdots - Loading view: admin.TBDots.index');
        return view('admin.TBDots.index', compact('tbdots'));
    }

    public function create()
    {
        $appointments = Appointment::where('status', 'pending')->get();
        return view('admin.TBDots.create', compact('appointments'));
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

        return redirect()->route('admin.tbdots.index')
            ->with('success', 'TB-DOTS record created successfully.');
    }

    public function show(Tbdot $tbdot)
    {
        return view('admin.TBDots.show', compact('tbdot'));
    }

    public function edit(Tbdot $tbdot)
    {
        $appointments = Appointment::all();
        return view('admin.TBDots.edit', compact('tbdot', 'appointments'));
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

        return redirect()->route('admin.tbdots.index')
            ->with('success', 'TB-DOTS record updated successfully.');
    }

    public function destroy(Tbdot $tbdot)
    {
        $tbdot->delete();
        return redirect()->route('admin.tbdots.index')
            ->with('success', 'TB-DOTS record deleted successfully.');
    }
}
