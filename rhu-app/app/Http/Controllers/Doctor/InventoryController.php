<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index()
    {
        try {
            $medicines = Medicine::all();
            $lowStockItems = Medicine::whereRaw('current_stock <= minimum_stock')->get();
            $expiredItems = Medicine::where('expiry_date', '<', now())->get();
            $outOfStockItems = Medicine::where('current_stock', '<=', 0)->get();
            
            return view('admin.inventory.index', compact('medicines', 'lowStockItems', 'expiredItems', 'outOfStockItems'));
        } catch (\Exception $e) {
            \Log::error('Inventory Index Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to load inventory. Please contact administrator.');
        }
    }

    public function create()
    {
        return view('admin.inventory.create');
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

        return redirect()->route('admin.inventory.index')
            ->with('success', 'Medicine added to inventory successfully.');
    }

    public function show(Medicine $medicine)
    {
        $prescriptionItems = $medicine->prescriptionItems()->with(['prescription.appointment'])->latest()->get();
        return view('admin.inventory.show', compact('medicine', 'prescriptionItems'));
    }

    public function edit(Medicine $medicine)
    {
        return view('admin.inventory.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        try {
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

            return redirect()->route('admin.inventory.index')
                ->with('success', 'Medicine updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Medicine Update Error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Unable to update medicine. Please try again.')
                ->withInput();
        }
    }

    public function destroy(Medicine $medicine)
    {
        if ($medicine->prescriptionItems()->exists()) {
            return redirect()->route('admin.inventory.index')
                ->with('error', 'Cannot delete medicine with existing prescriptions.');
        }

        $medicine->delete();
        return redirect()->route('admin.inventory.index')
            ->with('success', 'Medicine removed from inventory.');
    }

    public function adjustStock(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'adjustment_type' => 'required|in:add,subtract',
            'quantity' => 'required|integer|min:1',
            'reason' => 'required|string|max:255'
        ]);

        try {
            DB::transaction(function () use ($medicine, $validated) {
                if ($validated['adjustment_type'] === 'add') {
                    $medicine->increment('current_stock', $validated['quantity']);
                } else {
                    if ($medicine->current_stock < $validated['quantity']) {
                        throw new \Exception('Cannot subtract more than current stock.');
                    }
                    $medicine->decrement('current_stock', $validated['quantity']);
                }
                
                // Update status based on stock level
                if ($medicine->current_stock <= 0) {
                    $medicine->update(['status' => 'Out of Stock']);
                } elseif ($medicine->status === 'Out of Stock' && $medicine->current_stock > 0) {
                    $medicine->update(['status' => 'Active']);
                }
            });

            return redirect()->route('admin.inventory.index')
                ->with('success', 'Stock adjusted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }
}
