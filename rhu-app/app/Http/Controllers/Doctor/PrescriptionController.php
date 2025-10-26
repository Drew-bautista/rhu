<?php
namespace App\Http\Controllers\Doctor;
use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\Medicine;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
    public function index()
    {
        try {
            $prescriptions = Prescription::on('mysql')->with([
                    'appointment',
                    'prescriptionItems.medicine',
                    'prescribedBy'
                ])
                ->latest()
                ->paginate(20);

            $pendingCount = Prescription::on('mysql')->where('status', 'pending')->count();

            return view('admin.prescriptions.index', compact('prescriptions', 'pendingCount'));
            
        } catch (\Exception $e) {
            \Log::error('Prescription Index Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Return simple response to test
            return response()->json([
                'error' => 'Prescription index failed',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function create()
    {
        try {
            \Log::info('Prescription create method called');
            
            // Explicitly use mysql connection for all queries
            $appointments = Appointment::on('mysql')->where('status', 'pending')
                ->orWhere('status', 'confirmed')
                ->latest()
                ->get();
                
            \Log::info('Appointments loaded: ' . $appointments->count());
            
            $medicines = Medicine::on('mysql')->where('status', 'Active')->orderBy('medicine_name')->get();
            
            \Log::info('Medicines loaded: ' . $medicines->count());
            
            return view('admin.prescriptions.create', compact('appointments', 'medicines'));
            
        } catch (\Exception $e) {
            \Log::error('Prescription Create Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'error' => 'Prescription create failed',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'nullable|exists:appointments,id',
            'patient_name' => 'required|string|max:255',
            'patient_age' => 'nullable|integer|min:1|max:120',
            'patient_contact' => 'nullable|string|max:20',
            'prescription_date' => 'required|date',
            'doctor_name' => 'required|string|max:255',
            'diagnosis' => 'nullable|string',
            'symptoms' => 'nullable|string',
            'medical_history' => 'nullable|string',
            'notes' => 'nullable|string',
            'follow_up_date' => 'nullable|date|after:today',
            'follow_up_notes' => 'nullable|string',
            
            // Prescription items
            'medicines' => 'required|array|min:1',
            'medicines.*.medicine_id' => 'required|exists:medicines,id',
            'medicines.*.quantity' => 'required|integer|min:1',
            'medicines.*.dosage' => 'required|string|max:255',
            'medicines.*.frequency' => 'required|string|max:255',
            'medicines.*.duration' => 'required|string|max:255',
            'medicines.*.instructions' => 'nullable|string',
        ], [
            // Custom error messages
            'patient_name.required' => 'Patient name is required.',
            'patient_name.max' => 'Patient name cannot be longer than 255 characters.',
            'patient_age.integer' => 'Patient age must be a valid number.',
            'patient_age.min' => 'Patient age must be at least 1 year old.',
            'patient_age.max' => 'Patient age cannot be more than 120 years old.',
            'patient_contact.max' => 'Contact number cannot be longer than 20 characters.',
            'prescription_date.required' => 'Prescription date is required.',
            'prescription_date.date' => 'Prescription date must be a valid date.',
            'doctor_name.required' => 'Doctor name is required.',
            'doctor_name.max' => 'Doctor name cannot be longer than 255 characters.',
            'follow_up_date.date' => 'Follow-up date must be a valid date.',
            'follow_up_date.after' => 'Follow-up date must be after the prescription date.',
            'medicines.required' => 'At least one medicine must be prescribed.',
            'medicines.min' => 'At least one medicine must be prescribed.',
            'medicines.*.medicine_id.required' => 'Please select a medicine.',
            'medicines.*.medicine_id.exists' => 'Selected medicine is not valid.',
            'medicines.*.quantity.required' => 'Medicine quantity is required.',
            'medicines.*.quantity.integer' => 'Medicine quantity must be a valid number.',
            'medicines.*.quantity.min' => 'Medicine quantity must be at least 1.',
            'medicines.*.dosage.required' => 'Medicine dosage is required.',
            'medicines.*.dosage.max' => 'Medicine dosage cannot be longer than 255 characters.',
            'medicines.*.frequency.required' => 'Medicine frequency is required.',
            'medicines.*.frequency.max' => 'Medicine frequency cannot be longer than 255 characters.',
            'medicines.*.duration.required' => 'Medicine duration is required.',
            'medicines.*.duration.max' => 'Medicine duration cannot be longer than 255 characters.',
        ]);

        // Additional validation before processing
        if (empty($validated['medicines']) || count($validated['medicines']) === 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'You must add at least one medicine to the prescription.');
        }

        // Check if patient name is just spaces
        if (trim($validated['patient_name']) === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Patient name cannot be empty or just spaces.');
        }

        try {
            DB::transaction(function () use ($validated) {
                // Generate prescription number
                $prescriptionNumber = Prescription::generatePrescriptionNumber();
                
                // Set default values for required fields if not provided
                if (empty($validated['prescription_date'])) {
                    $validated['prescription_date'] = now()->format('Y-m-d');
                }
                if (empty($validated['doctor_name'])) {
                    $validated['doctor_name'] = auth()->user()->name ?? 'Unknown Doctor';
                }

                // Aggregate medicine data for summary columns
                $totalQuantity = 0;
                $dosageInstructions = null;
                $durationDays = null;

                if (!empty($validated['medicines'])) {
                    foreach ($validated['medicines'] as $idx => $medicineData) {
                        $totalQuantity += (int) $medicineData['quantity'];
                        if ($idx === 0) {
                            $parts = [];
                            if (!empty($medicineData['dosage'])) {
                                $parts[] = $medicineData['dosage'];
                            }
                            if (!empty($medicineData['frequency'])) {
                                $parts[] = $medicineData['frequency'];
                            }
                            $dosageInstructions = !empty($parts) ? implode(' • ', $parts) : null;

                            if (!empty($medicineData['duration']) && preg_match('/\d+/', $medicineData['duration'], $matches)) {
                                $durationDays = (int) $matches[0];
                            }
                        }
                    }
                }
                
                // Create prescription with all possible fields
                $prescriptionData = [
                    'appointment_id' => $validated['appointment_id'] ?? null,
                    'inventory_id' => null, // Set to null for now
                    'patient_name' => $validated['patient_name'],
                    'patient_age' => $validated['patient_age'] ?? null,
                    'patient_contact' => $validated['patient_contact'] ?? null,
                    'prescription_number' => $prescriptionNumber,
                    'prescription_date' => $validated['prescription_date'],
                    'doctor_name' => $validated['doctor_name'],
                    'prescribed_by' => auth()->id(), // Set to current user ID
                    'diagnosis' => $validated['diagnosis'] ?? null,
                    'symptoms' => $validated['symptoms'] ?? null,
                    'medical_history' => $validated['medical_history'] ?? null,
                    'status' => 'pending',
                    'notes' => $validated['notes'] ?? null,
                    'follow_up_date' => $validated['follow_up_date'] ?? null,
                    'follow_up_notes' => $validated['follow_up_notes'] ?? null,
                    'quantity_prescribed' => $totalQuantity ?: null,
                    'dosage_instructions' => $dosageInstructions,
                    'duration_days' => $durationDays,
                    'special_instructions' => $validated['notes'] ?? null,
                ];
                
                $prescription = Prescription::create($prescriptionData);

                // Validate medicines before creating prescription items
                foreach ($validated['medicines'] as $index => $medicineData) {
                    $medicine = Medicine::find($medicineData['medicine_id']);
                    
                    if (!$medicine) {
                        throw new \Exception("Medicine #" . ($index + 1) . " is not valid. Please select a valid medicine.");
                    }
                    
                    if (!$medicine->status || $medicine->status !== 'Active') {
                        throw new \Exception("Medicine '{$medicine->medicine_name}' is not active and cannot be prescribed.");
                    }
                    
                    // Check stock availability
                    if ($medicine->current_stock < $medicineData['quantity']) {
                        throw new \Exception("Insufficient stock for '{$medicine->medicine_name}'. Available: {$medicine->current_stock}, Requested: {$medicineData['quantity']}");
                    }
                    
                    // Check if medicine is expired
                    if ($medicine->expiry_date && $medicine->expiry_date < now()) {
                        throw new \Exception("Medicine '{$medicine->medicine_name}' has expired on {$medicine->expiry_date->format('Y-m-d')} and cannot be prescribed.");
                    }
                }

                // Create prescription items
                foreach ($validated['medicines'] as $medicineData) {
                    $medicine = Medicine::findOrFail($medicineData['medicine_id']);

                    PrescriptionItem::create([
                        'prescription_id' => $prescription->id,
                        'medicine_id' => $medicineData['medicine_id'],
                        'quantity' => $medicineData['quantity'],
                        'dosage' => $medicineData['dosage'],
                        'frequency' => $medicineData['frequency'],
                        'duration' => $medicineData['duration'],
                        'instructions' => $medicineData['instructions'],
                        'status' => 'Pending',
                    ]);

                    // Reduce medicine stock
                    $medicine->decrement('current_stock', $medicineData['quantity']);
                }
            });

            return redirect()->route('admin.prescriptions.index')
                ->with('success', 'Prescription created successfully.');
                
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Database error creating prescription: ' . $e->getMessage());
            
            // Check for specific database errors and provide user-friendly messages
            $errorMessage = 'Error creating prescription. Please check your input and try again.';
            
            if (str_contains($e->getMessage(), "doesn't have a default value")) {
                $errorMessage = 'Database configuration error. Please contact the administrator to fix missing field defaults.';
            } elseif (str_contains($e->getMessage(), 'Duplicate entry')) {
                $errorMessage = 'A prescription with this information already exists. Please check and try again.';
            } elseif (str_contains($e->getMessage(), 'cannot be null')) {
                $errorMessage = 'Required information is missing. Please fill in all required fields.';
            } elseif (str_contains($e->getMessage(), 'foreign key constraint')) {
                $errorMessage = 'Invalid reference data. Please check your selections and try again.';
            }
            
            return redirect()->back()
                ->withInput()
                ->with('error', $errorMessage);
                
        } catch (\Exception $e) {
            \Log::error('Error creating prescription: ' . $e->getMessage());
            
            // Handle other types of errors
            $errorMessage = $e->getMessage();
            if (str_contains($errorMessage, 'Insufficient stock')) {
                // Stock error - show as is since it's user-friendly
            } else {
                $errorMessage = 'An unexpected error occurred while creating the prescription. Please try again.';
            }
            
            return redirect()->back()
                ->withInput()
                ->with('error', $errorMessage);
        }
    }

    public function show(Prescription $prescription)
    {
        $prescription->setConnection('mysql');
        $prescription->load(['appointment', 'prescriptionItems.medicine', 'prescribedBy', 'dispensedBy']);

        $prescriptionItems = $prescription->prescriptionItems;

        $hasSufficientStock = $prescriptionItems->every(function ($item) {
            return $item->medicine && $item->medicine->current_stock >= $item->quantity;
        });

        $insufficientItems = $prescriptionItems->filter(function ($item) {
            return !$item->medicine || $item->medicine->current_stock < $item->quantity;
        });

        return view('admin.prescriptions.show', compact(
            'prescription',
            'prescriptionItems',
            'hasSufficientStock',
            'insufficientItems'
        ));
    }

    public function edit(Prescription $prescription)
    {
        if ($prescription->status !== 'Draft') {
            return redirect()->route('admin.prescriptions.index')
                ->with('error', 'Only draft prescriptions can be edited.');
        }

        $appointments = Appointment::where('status', 'pending')
            ->orWhere('status', 'confirmed')
            ->latest()
            ->get();
        $medicines = Medicine::active()->orderBy('medicine_name')->get();
        
        $prescription->load(['prescriptionItems.medicine']);
        
        return view('admin.prescriptions.edit', compact('prescription', 'appointments', 'medicines'));
    }

    public function update(Request $request, Prescription $prescription)
    {
        if ($prescription->status !== 'Draft') {
            return redirect()->route('admin.prescriptions.index')
                ->with('error', 'Only draft prescriptions can be updated.');
        }

        $validated = $request->validate([
            'appointment_id' => 'nullable|exists:appointments,id',
            'patient_name' => 'required|string|max:255',
            'patient_age' => 'required|integer|min:0',
            'patient_contact' => 'nullable|string|max:20',
            'prescription_date' => 'required|date',
            'doctor_name' => 'required|string|max:255',
            'diagnosis' => 'nullable|string',
            'symptoms' => 'nullable|string',
            'medical_history' => 'nullable|string',
            'notes' => 'nullable|string',
            'follow_up_date' => 'nullable|date|after:prescription_date',
            'follow_up_notes' => 'nullable|string',
            'medicines' => 'required|array|min:1',
            'medicines.*.medicine_id' => 'required|exists:medicines,id',
            'medicines.*.quantity' => 'required|integer|min:1',
            'medicines.*.dosage' => 'required|string|max:100',
            'medicines.*.frequency' => 'required|string|max:100',
            'medicines.*.duration' => 'required|string|max:100',
            'medicines.*.instructions' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($validated, $prescription) {
            // Update prescription
            $prescription->update($validated);

            // Delete existing prescription items
            $prescription->prescriptionItems()->delete();

            // Add new prescription items
            foreach ($validated['medicines'] as $medicineData) {
                $prescription->prescriptionItems()->create($medicineData);
            }
        });

        return redirect()->route('admin.prescriptions.index')
            ->with('success', 'Prescription updated successfully.');
    }

    public function destroy(Prescription $prescription)
    {
        if ($prescription->status === 'Dispensed' || $prescription->status === 'Completed') {
            return redirect()->route('admin.prescriptions.index')
                ->with('error', 'Cannot delete dispensed or completed prescriptions.');
        }

        // Restore medicine stock
        foreach ($prescription->prescriptionItems as $item) {
            $item->medicine->increment('current_stock', $item->quantity - $item->dispensed_quantity);
        }

        $prescription->delete();
        
        return redirect()->route('admin.prescriptions.index')
            ->with('success', 'Prescription deleted successfully.');
    }

    public function pending()
    {
        $prescriptions = Prescription::on('mysql')->with(['appointment', 'prescriptionItems.medicine'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(20);
        
        return view('admin.prescriptions.pending', compact('prescriptions'));
    }

    public function dispense(Request $request, Prescription $prescription)
    {
        if ($prescription->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending prescriptions can be dispensed.');
        }

        $prescription->update([
            'status' => 'dispensed',
            'dispensed_at' => now(),
            'dispensed_by' => auth()->id()
        ]);

        return redirect()->route('admin.prescriptions.index')
            ->with('success', 'Prescription dispensed successfully.');
    }

    public function cancel(Request $request, Prescription $prescription)
    {
        if ($prescription->status === 'dispensed' || $prescription->status === 'completed') {
            return redirect()->back()->with('error', 'Cannot cancel dispensed or completed prescriptions.');
        }

        // Restore medicine stock
        foreach ($prescription->prescriptionItems as $item) {
            $item->medicine->increment('current_stock', $item->quantity);
        }

        $prescription->update([
            'status' => 'cancelled'
        ]);

        return redirect()->route('admin.prescriptions.index')
            ->with('success', 'Prescription cancelled successfully.');
    }

    public function patientHistory($patientName)
    {
        $prescriptions = Prescription::with(['appointment', 'prescriptionItems.medicine'])
            ->whereHas('appointment', function($query) use ($patientName) {
                $query->where('name', 'like', '%' . $patientName . '%');
            })
            ->latest()
            ->paginate(20);
        
        return view('admin.prescriptions.patient-history', compact('prescriptions', 'patientName'));
    }
}
