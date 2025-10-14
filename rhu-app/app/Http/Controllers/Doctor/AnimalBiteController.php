<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\AnimalBiteCase;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AnimalBiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $animalBiteCases = AnimalBiteCase::with('appointment')->latest()->get();

        return view('admin.animal-bite.index', compact('animalBiteCases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // kunin appointments kung kailangan sa dropdown
        $appointments = Appointment::latest()->get();

        return view('admin.animal-bite.create', compact('appointments'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

        return redirect()->route('admin.animal-bite.index')->with('success', 'Animal bite case added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnimalBiteCase $animalBiteCase)
    {
        return view('admin.animal-bite.show', compact('animalBiteCase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnimalBiteCase $animalBiteCase)
    {
        $appointments = Appointment::latest()->get();

        return view('admin.animal-bite.edit', compact('animalBiteCase', 'appointments'));
    }

    /**
     * Update the specified resource in storage.
     */
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

        return redirect()->route('admin.animal-bite.index')->with('success', 'Animal bite case updated successfully.');
    }


    public function destroy(AnimalBiteCase $animalBiteCase)
    {
        $animalBiteCase->delete();

        return redirect()->route('admin.animal-bite.index')->with('success', 'Animal bite case deleted successfully.');
    }
}
