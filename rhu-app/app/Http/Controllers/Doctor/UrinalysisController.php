<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\UrinalysisResult;
use Illuminate\Http\Request;

class UrinalysisController extends Controller
{
    public function index()
    {
        $urinalysisResults = UrinalysisResult::with('appointments')->get();
        return view('admin.urinalysis-results.index', compact('urinalysisResults'));
    }

    public function create()
    {
        $appointments = Appointment::all();
        return view('admin.urinalysis-results.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            // 'test_date' => 'required|date',
            'color' => 'nullable|string|max:255',
            'transparency' => 'nullable|string|max:255',
            'specific_gravity' => 'nullable|numeric',
            'ph' => 'nullable|numeric',
            'protein' => 'nullable|string|max:255',
            'glucose' => 'nullable|string|max:255',
            'ketones' => 'nullable|string|max:255',
            'bilirubin' => 'nullable|string|max:255',
            'urobilinogen' => 'nullable|string|max:255',
            'nitrite' => 'nullable|string|max:255',
            'leukocyte_esterase' => 'nullable|string|max:255',
            'rbc' => 'nullable|string|max:255',
            'wbc' => 'nullable|string|max:255',
            'epithelial_cells' => 'nullable|string|max:255',
            'bacteria' => 'nullable|string|max:255',
            'crystals' => 'nullable|string|max:255',
            'casts' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        UrinalysisResult::create([
            'appointment_id' => $request->appointment_id,
            // 'test_date' => $request->test_date,
            'color' => $request->color,
            'transparency' => $request->transparency,
            'specific_gravity' => $request->specific_gravity,
            'ph' => $request->ph,
            'protein' => $request->protein,
            'glucose' => $request->glucose,
            'ketones' => $request->ketones,
            'bilirubin' => $request->bilirubin,
            'urobilinogen' => $request->urobilinogen,
            'nitrite' => $request->nitrite,
            'leukocyte_esterase' => $request->leukocyte_esterase,
            'rbc' => $request->rbc,
            'wbc' => $request->wbc,
            'epithelial_cells' => $request->epithelial_cells,
            'bacteria' => $request->bacteria,
            'crystals' => $request->crystals,
            'casts' => $request->casts,
            'remarks' => $request->remarks,
        ]);
        return redirect()->route('admin.urinalysis-results.index')->with('success', 'Urinalysis result created successfully.');
    }

    public function show($id)
    {
        $urinalysisResult = UrinalysisResult::with('appointments')->findOrFail($id);
        return view('admin.urinalysis-results.show', compact('urinalysisResult'));
    }

    public function edit($id)
    {
        $urinalysisResult = UrinalysisResult::findOrFail($id);
        $appointments = Appointment::all();
        return view('admin.urinalysis-results.edit', compact('urinalysisResult', 'appointments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'appointment_id' => 'required|exists:appointments,id',
            // 'test_date' => 'required|date',
            'color' => 'nullable|string|max:255',
            'transparency' => 'nullable|string|max:255',
            'specific_gravity' => 'nullable|numeric',
            'ph' => 'nullable|numeric',
            'protein' => 'nullable|string|max:255',
            'glucose' => 'nullable|string|max:255',
            'ketones' => 'nullable|string|max:255',
            'bilirubin' => 'nullable|string|max:255',
            'urobilinogen' => 'nullable|string|max:255',
            'nitrite' => 'nullable|string|max:255',
            'leukocyte_esterase' => 'nullable|string|max:255',
            'rbc' => 'nullable|string|max:255',
            'wbc' => 'nullable|string|max:255',
            'epithelial_cells' => 'nullable|string|max:255',
            'bacteria' => 'nullable|string|max:255',
            'crystals' => 'nullable|string|max:255',
            'casts' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        $urinalysisResult = UrinalysisResult::findOrFail($id);
        $urinalysisResult->update([
            // 'appointment_id' => $request->appointment_id,
            // 'test_date' => $request->test_date,
            'color' => $request->color,
            'transparency' => $request->transparency,
            'specific_gravity' => $request->specific_gravity,
            'ph' => $request->ph,
            'protein' => $request->protein,
            'glucose' => $request->glucose,
            'ketones' => $request->ketones,
            'bilirubin' => $request->bilirubin,
            'urobilinogen' => $request->urobilinogen,
            'nitrite' => $request->nitrite,
            'leukocyte_esterase' => $request->leukocyte_esterase,
            'rbc' => $request->rbc,
            'wbc' => $request->wbc,
            'epithelial_cells' => $request->epithelial_cells,
            'bacteria' => $request->bacteria,
            'crystals' => $request->crystals,
            'casts' => $request->casts,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('admin.urinalysis-results.index')->with('success', 'Urinalysis result updated successfully.');
    }

    public function destroy($id)
    {
        $urinalysisResult = UrinalysisResult::findOrFail($id);
        $urinalysisResult->delete();
        return redirect()->route('admin.urinalysis-results.index')->with('success', 'Urinalysis result deleted successfully.');
    }
}
