<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::latest()->get();
        $lowStockItems = Inventory::whereColumn('quantity_in_stock', '<=', 'reorder_level')->get();
        return view('admin.inventory.index', compact('inventory', 'lowStockItems'));
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

        return redirect()->route('admin.inventory.index')
            ->with('success', 'Medicine added to inventory successfully.');
    }

    public function show(Inventory $inventory)
    {
        $prescriptions = $inventory->prescriptions()->with(['appointment', 'prescribedBy', 'dispensedBy'])->latest()->get();
        return view('admin.inventory.show', compact('inventory', 'prescriptions'));
    }

    public function edit(Inventory $inventory)
    {
        return view('admin.inventory.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        try {
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

            return redirect()->route('admin.inventory.index')
                ->with('success', 'Inventory updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Inventory Update Error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Unable to update inventory. Please try again.')
                ->withInput();
        }
    }

    public function destroy(Inventory $inventory)
    {
        if ($inventory->prescriptions()->exists()) {
            return redirect()->route('admin.inventory.index')
                ->with('error', 'Cannot delete medicine with existing prescriptions.');
        }

        $inventory->delete();
        return redirect()->route('admin.inventory.index')
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
