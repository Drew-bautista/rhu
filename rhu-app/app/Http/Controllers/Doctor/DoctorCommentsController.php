<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorCommentsController extends Controller
{
    public function create()
    {
        $treatments = Treatment::whereNull('interpretation_comments')
            ->whereNull('recommendations')
            ->whereNull('prescriptions')
            ->whereNull('result_summary')
            ->with('user')
            ->get();

        return view('admin.treatment.create-comments', compact('treatments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'interpretation_comments' => 'required|string',
            'recommendations' => 'required|string',
            'prescriptions' => 'required|string',
            'result_summary' => 'required|string',
            'treatment_id' => 'required|exists:treatments,id',
        ]);

        $treatment = Treatment::findOrFail($request->treatment_id);
        $treatment->update([
            'interpretation_comments' => $request->interpretation_comments,
            'recommendations' => $request->recommendations,
            'prescriptions' => $request->prescriptions,
            'result_summary' => $request->result_summary,
        ]);

        return redirect()->route('admin.treatment.show', $treatment->id)->with('success', 'Comments added successfully.');
    }

    public function edit($id)
    {
        $treatment = Treatment::findOrFail($id);
        return view('admin.treatment.edit-comments', compact('treatment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'interpretation_comments' => 'required|string',
            'recommendations' => 'required|string',
            'prescriptions' => 'required|string',
            'result_summary' => 'required|string',
        ]);

        $treatment = Treatment::findOrFail($id);
        $treatment->update([
            'interpretation_comments' => $request->interpretation_comments,
            'recommendations' => $request->recommendations,
            'prescriptions' => $request->prescriptions,
            'result_summary' => $request->result_summary,
        ]);

        return redirect()->route('admin.treatment.show', $treatment->id)->with('success', 'Doctor comments updated successfully.');
    }
}
