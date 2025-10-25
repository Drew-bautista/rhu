<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffInventoryController extends Controller
{
    public function index()
    {
        $medicines = Medicine::all();
        $lowStockItems = Medicine::whereRaw('current_stock <= minimum_stock')->get();
        $expiredItems = Medicine::where('expiry_date', '<', now())->get();
        $outOfStockItems = Medicine::where('current_stock', '<=', 0)->get();
        
        return view('staff.inventory.index', compact('medicines', 'lowStockItems', 'expiredItems', 'outOfStockItems'));
    }

    public function create()
    {
        return view('staff.inventory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'medicine_name' => 'required|string|max:255',
            'generic_name' => 'nullable|string|max:255',
            'brand_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'dosage_form' => 'required|in:tablet,capsule,syrup,injection,cream,drops,inhaler,ointment,powder,other',
            'strength' => 'required|string',
            'unit' => 'required|string',
            'current_stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'maximum_stock' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'category' => 'nullable|string',
            'classification' => 'required|in:Prescription,OTC',
            'expiry_date' => 'nullable|date|after:today',
            'batch_number' => 'nullable|string',
            'manufacturer' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
            'notes' => 'nullable|string'
        ]);

        Medicine::create($validated);

        return redirect()->route('staff.inventory.index')
            ->with('success', 'Medicine added to inventory successfully.');
    }

    public function show(Medicine $medicine)
    {
        try {
            $prescriptionItems = $medicine->prescriptionItems()->with(['prescription.appointment'])->latest()->get();
            return view('staff.inventory.show', compact('medicine', 'prescriptionItems'));
        } catch (\Exception $e) {
            \Log::error('Medicine Show Error: ' . $e->getMessage());
            return redirect()->route('staff.inventory.index')
                ->with('error', 'Unable to load medicine details. Please try again.');
        }
    }

    public function edit(Medicine $medicine)
    {
        return view('staff.inventory.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'medicine_name' => 'required|string|max:255',
            'generic_name' => 'nullable|string|max:255',
            'brand_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'dosage_form' => 'required|in:tablet,capsule,syrup,injection,cream,drops,inhaler,ointment,powder,other',
            'strength' => 'required|string',
            'unit' => 'required|string',
            'current_stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'maximum_stock' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'category' => 'nullable|string',
            'classification' => 'required|in:Prescription,OTC',
            'expiry_date' => 'nullable|date',
            'batch_number' => 'nullable|string',
            'manufacturer' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
            'notes' => 'nullable|string'
        ]);

        $medicine->update($validated);

        return redirect()->route('staff.inventory.index')
            ->with('success', 'Medicine updated successfully.');
    }

    public function destroy(Medicine $medicine)
    {
        if ($medicine->prescriptionItems()->exists()) {
            return redirect()->route('staff.inventory.index')
                ->with('error', 'Cannot delete medicine with existing prescriptions.');
        }

        $medicine->delete();
        return redirect()->route('staff.inventory.index')
            ->with('success', 'Medicine removed from inventory.');
    }

}
