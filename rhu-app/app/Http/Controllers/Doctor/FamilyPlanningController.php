<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\FamilyPlanning;
use Illuminate\Http\Request;

class FamilyPlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $familyPlannings = FamilyPlanning::latest()->get();
        return view('admin.family-planning.index', compact('familyPlannings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.family-planning.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:120',
            'contact' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            // 'date_of_visit' => 'required|date',
            'fp_counseling' => 'required|string|max:255',
            'fp_commodity' => 'required|string|max:255',
            'facility' => 'required|string|max:255',
            'date_of_follow_up' => 'required|date',
        ]);

        FamilyPlanning::create($validatedData);

        return redirect()->route('admin.family-planning.index')->with('success', 'Family Planning data created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $familyPlanning = FamilyPlanning::findOrFail($id);
        return view('admin.family-planning.show', compact('familyPlanning'));
    }

    public function edit(string $id)
    {
        $familyPlanning = FamilyPlanning::findOrFail($id);
        return view('admin.family-planning.edit', compact('familyPlanning'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $familyPlanning = FamilyPlanning::findOrFail($id);
            
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'age' => 'required|integer|min:0|max:120',
                'contact' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'fp_counseling' => 'required|string|max:255',
                'fp_commodity' => 'required|string|max:255',
                'facility' => 'required|string|max:255',
                'date_of_follow_up' => 'required|date',
            ]);

            $familyPlanning->update($validatedData);

            return redirect()->route('admin.family-planning.index')->with('success', 'Family Planning data updated successfully.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating record: ' . $e->getMessage())->withInput();
        }
    }


    public function destroy(string $id)
    {
        $familyPlanning = FamilyPlanning::findOrFail($id);
        $familyPlanning->delete();

        return redirect()->route('admin.family-planning.index')->with('success', 'Family Planning data deleted successfully.');
    }
}
