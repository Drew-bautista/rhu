<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffInventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::all();
        $lowStockItems = Inventory::whereColumn('quantity_in_stock', '<=', 'reorder_level')->get();
        return view('staff.inventory.index', compact('inventory', 'lowStockItems'));
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
            'medicine_type' => 'required|in:tablet,capsule,syrup,injection,cream,drops,inhaler,other',
            'dosage_strength' => 'required|string',
            'quantity_in_stock' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'unit_of_measure' => 'required|string',
            'expiry_date' => 'nullable|date',
            'batch_number' => 'nullable|string',
            'supplier' => 'nullable|string',
            'storage_location' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        Inventory::create($validated);

        return redirect()->route('staff.inventory.index')
            ->with('success', 'Medicine added to inventory successfully.');
    }

    public function show(Inventory $inventory)
    {
        try {
            $prescriptions = $inventory->prescriptions()->with(['appointment', 'prescribedBy', 'dispensedBy'])->latest()->get();
            return view('staff.inventory.show', compact('inventory', 'prescriptions'));
        } catch (\Exception $e) {
            \Log::error('Inventory Show Error: ' . $e->getMessage());
            return redirect()->route('staff.inventory.index')
                ->with('error', 'Unable to load inventory details. Please try again.');
        }
    }

    public function edit(Inventory $inventory)
    {
        return view('staff.inventory.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'medicine_name' => 'required|string|max:255',
            'generic_name' => 'nullable|string|max:255',
            'brand_name' => 'nullable|string|max:255',
            'medicine_type' => 'required|in:tablet,capsule,syrup,injection,cream,drops,inhaler,other',
            'dosage_strength' => 'required|string',
            'quantity_in_stock' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'unit_of_measure' => 'required|string',
            'expiry_date' => 'nullable|date',
            'batch_number' => 'nullable|string',
            'supplier' => 'nullable|string',
            'storage_location' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        $inventory->update($validated);

        return redirect()->route('staff.inventory.index')
            ->with('success', 'Inventory updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        if ($inventory->prescriptions()->exists()) {
            return redirect()->route('staff.inventory.index')
                ->with('error', 'Cannot delete medicine with existing prescriptions.');
        }

        $inventory->delete();
        return redirect()->route('staff.inventory.index')
            ->with('success', 'Medicine removed from inventory.');
    }

    public function prescribe(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'inventory_id' => 'required|exists:inventory,id',
            'patient_name' => 'required|string',
            'quantity_prescribed' => 'required|integer|min:1',
            'dosage_instructions' => 'required|string',
            'duration_days' => 'required|integer|min:1',
            'special_instructions' => 'nullable|string'
        ]);

        DB::transaction(function () use ($validated) {
            $inventory = Inventory::findOrFail($validated['inventory_id']);
            
            // Check if enough stock
            if ($inventory->quantity_in_stock < $validated['quantity_prescribed']) {
                throw new \Exception('Insufficient stock for this medicine.');
            }

            // Create prescription
            $prescription = Prescription::create([
                'appointment_id' => $validated['appointment_id'],
                'inventory_id' => $validated['inventory_id'],
                'prescribed_by' => auth()->id(),
                'patient_name' => $validated['patient_name'],
                'quantity_prescribed' => $validated['quantity_prescribed'],
                'dosage_instructions' => $validated['dosage_instructions'],
                'duration_days' => $validated['duration_days'],
                'special_instructions' => $validated['special_instructions'] ?? null,
                'status' => 'pending'
            ]);

            // Update inventory stock
            $inventory->decrement('quantity_in_stock', $validated['quantity_prescribed']);
        });

        return back()->with('success', 'Prescription created and inventory updated.');
    }
}
