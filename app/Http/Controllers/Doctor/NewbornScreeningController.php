<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewbornScreening;


class NewbornScreeningController extends Controller
{
    public function index()
    {
        $screenings = NewbornScreening::latest()->paginate(10);
        return view('admin.newborn_screenings.index', compact('screenings'));
    }

    public function create()
    {
        return view('admin.newborn_screenings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'date_of_birth' => 'required|date',
            'time_of_birth' => 'nullable',
            'birth_weight' => 'nullable|numeric',
            'gestational_age' => 'nullable|integer',
            'place_of_birth' => 'nullable|string|max:255',


            'mother_name' => 'required|string|max:255',
            'mother_age' => 'nullable|integer',
            'mother_address' => 'nullable|string|max:500',
            'mother_contact' => 'nullable|string|max:20',


            'screening_date' => 'required|date',
            'facility' => 'nullable|string|max:255',
            'kit_no' => 'nullable|string|max:255',
            'sample_collection_at' => 'nullable|date',
            'specimen_type' => 'nullable|string|max:255',

            'conditions_tested' => 'nullable|string|max:1000', // changed to string to accept JSON
            'result_status' => 'in:Normal,Positive,Retest',
            'remarks' => 'nullable|string|max:1000',

            'provider_name' => 'nullable|string|max:255',
            'provider_role' => 'nullable|string|max:255',



            // 'conditions_tested.*' => 'string|max:255',

        ]);

        // If multiple conditions selected
        if ($request->has('conditions_tested')) {
            $validated['conditions_tested'] = $request->input('conditions_tested');
        }

        NewbornScreening::create($validated + $request->except('_token'));

        return redirect()->route('admin.newborn_screenings.index')->with('success', 'Newborn Screening Added!');
    }

    public function show(NewbornScreening $newborn_screening)
    {
        return view('admin.newborn_screenings.show', compact('newborn_screening'));
    }

    public function edit(NewbornScreening $newborn_screening)
    {
        return view('admin.newborn_screenings.edit', compact('newborn_screening'));
    }

    public function update(Request $request, NewbornScreening $newborn_screening)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'date_of_birth' => 'required|date',
            'time_of_birth' => 'nullable',
            'birth_weight' => 'nullable|numeric',
            'gestational_age' => 'nullable|integer',
            'place_of_birth' => 'nullable|string|max:255',

            'mother_name' => 'required|string|max:255',
            'mother_age' => 'nullable|integer',
            'mother_address' => 'nullable|string|max:500',
            'mother_contact' => 'nullable|string|max:20',

            'screening_date' => 'nullable|date',
            'facility' => 'nullable|string|max:255',
            'kit_no' => 'nullable|string|max:255',
            'sample_collection_at' => 'nullable|date',
            'specimen_type' => 'nullable|string|max:255',

            'conditions_tested' => 'nullable|string|max:1000', // accept JSON or comma separated
            'result_status' => 'in:Normal,Positive,Retest',
            'remarks' => 'nullable|string|max:1000',

            'provider_name' => 'nullable|string|max:255',
            'provider_role' => 'nullable|string|max:255',
        ]);

        // If multiple conditions selected
        if ($request->has('conditions_tested')) {
            $validated['conditions_tested'] = $request->input('conditions_tested');
        }

        $newborn_screening->update($validated + $request->except('_token', '_method'));

        return redirect()->route('admin.newborn_screenings.index')
            ->with('success', 'Newborn Screening Updated!');
    }


    public function destroy(NewbornScreening $newborn_screening)
    {
        $newborn_screening->delete();
        return redirect()->route('newborn_screenings.index')->with('success', 'Deleted Successfully!');
    }
}
