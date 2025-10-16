<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\AnimalBiteCase;
use App\Models\Appointment;
use Illuminate\Http\Request;

class StaffAnimalBiteController extends Controller
{
    public function index()
    {
        $animalBiteCases = AnimalBiteCase::with('appointment')->latest()->get();

        return view('staff.animal-bite.index', compact('animalBiteCases'));
    }

    public function create()
    {
        $appointments = Appointment::latest()->get();

        return view('staff.animal-bite.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'nullable|exists:appointments,id',
            'date_of_incident' => 'nullable|date',
            'animal_type' => 'nullable|string|max:255',
            'animal_ownership' => 'nullable|in:Owned,Stray',
            'animal_vaccination_status' => 'nullable|in:Vaccinated,Unvaccinated,Unknown',
            'animal_behavior' => 'nullable|in:Normal,Aggressive,Rabid Signs',
            'bite_site' => 'nullable|string|max:255',
            'bite_category' => 'nullable|in:I,II,III',
            'wound_description' => 'nullable|string',
            'first_consultation_date' => 'nullable|date',
            'arv_dose' => 'nullable|string|max:255',
            'arv_date' => 'nullable|date',
            'rig_administered' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        AnimalBiteCase::create($validated);

        return redirect()->route('staff.animal-bite.index')->with('success', 'Animal bite case added successfully.');
    }

    public function show(AnimalBiteCase $animalBiteCase)
    {
        return view('staff.animal-bite.show', compact('animalBiteCase'));
    }

    public function edit(AnimalBiteCase $animalBiteCase)
    {
        $appointments = Appointment::latest()->get();

        return view('staff.animal-bite.edit', compact('animalBiteCase', 'appointments'));
    }

    public function update(Request $request, AnimalBiteCase $animalBiteCase)
    {
        $validated = $request->validate([
            'appointment_id' => 'nullable|exists:appointments,id',
            'date_of_incident' => 'nullable|date',
            'animal_type' => 'nullable|string|max:255',
            'animal_ownership' => 'nullable|in:Owned,Stray',
            'animal_vaccination_status' => 'nullable|in:Vaccinated,Unvaccinated,Unknown',
            'animal_behavior' => 'nullable|in:Normal,Aggressive,Rabid Signs',
            'bite_site' => 'nullable|string|max:255',
            'bite_category' => 'nullable|in:I,II,III',
            'wound_description' => 'nullable|string',
            'first_consultation_date' => 'nullable|date',
            'arv_dose' => 'nullable|string|max:255',
            'arv_date' => 'nullable|date',
            'rig_administered' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        $animalBiteCase->update($validated);

        return redirect()->route('staff.animal-bite.index')->with('success', 'Animal bite case updated successfully.');
    }

    public function destroy(AnimalBiteCase $animalBiteCase)
    {
        $animalBiteCase->delete();

        return redirect()->route('staff.animal-bite.index')->with('success', 'Animal bite case deleted successfully.');
    }
}
