<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\NewbornScreening;
use Illuminate\Http\Request;

class StaffNewbornScreeningController extends Controller
{
    public function index()
    {
        $screenings = NewbornScreening::latest()->paginate(10);
        return view('staff.newborn_screenings.index', compact('screenings'));
    }

    public function create()
    {
        return view('staff.newborn_screenings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'sex' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'mother_name' => 'required|string|max:255',
            'screening_date' => 'required|date',
            'result_status' => 'required|in:normal,abnormal,pending',
            'remarks' => 'nullable|string'
        ]);

        NewbornScreening::create($validated);

        return redirect()->route('staff.newborn_screenings.index')
            ->with('success', 'Newborn screening record created successfully.');
    }

    public function show(NewbornScreening $newborn_screening)
    {
        return view('staff.newborn_screenings.show', compact('newborn_screening'));
    }

    public function edit(NewbornScreening $newborn_screening)
    {
        try {
            return view('staff.newborn_screenings.edit', compact('newborn_screening'));
        } catch (\Exception $e) {
            \Log::error('Newborn Screening Edit Error: ' . $e->getMessage());
            return redirect()->route('staff.newborn_screenings.index')
                ->with('error', 'Unable to load edit form. Please try again.');
        }
    }

    public function update(Request $request, NewbornScreening $newborn_screening)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'sex' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'mother_name' => 'required|string|max:255',
            'screening_date' => 'required|date',
            'result_status' => 'required|in:normal,abnormal,pending',
            'remarks' => 'nullable|string'
        ]);

        $newborn_screening->update($validated);

        return redirect()->route('staff.newborn_screenings.index')
            ->with('success', 'Newborn screening record updated successfully.');
    }

    public function destroy(NewbornScreening $newborn_screening)
    {
        $newborn_screening->delete();
        return redirect()->route('staff.newborn_screenings.index')
            ->with('success', 'Newborn screening record deleted successfully.');
    }
}
