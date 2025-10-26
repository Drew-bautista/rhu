<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\BirthCertificate;
use Illuminate\Http\Request;

class StaffBirthCertificateController extends Controller
{
    public function index()
    {
        $birthCertificates = BirthCertificate::latest()->paginate(10);
        return view('staff.birth-certificates.index', compact('birthCertificates'));
    }

    public function create()
    {
        return view('staff.birth-certificates.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                // Child Information
                'child_first_name' => 'required|string|max:255',
                'child_middle_name' => 'nullable|string|max:255',
                'child_last_name' => 'required|string|max:255',
                'child_sex' => 'required|in:Male,Female',
                'date_of_birth' => 'required|date',
                'time_of_birth' => 'required',
                'place_of_birth' => 'required|string|max:255',
                'birth_weight' => 'nullable|numeric|min:0',
                'birth_length' => 'nullable|numeric|min:0',
                'birth_order' => 'nullable|integer|min:1',
                'multiple_birth' => 'nullable|in:Single,Twin,Triplet,Other',
                
                // Mother Information
                'mother_first_name' => 'required|string|max:255',
                'mother_middle_name' => 'nullable|string|max:255',
                'mother_last_name' => 'required|string|max:255',
                'mother_citizenship' => 'nullable|string|max:255',
                'mother_religion' => 'nullable|string|max:255',
                'mother_occupation' => 'nullable|string|max:255',
                'mother_age_at_birth' => 'nullable|integer|min:0',
                'mother_residence' => 'nullable|string|max:500',
                'mother_address' => 'nullable|string|max:500',
                
                // Father Information
                'father_first_name' => 'nullable|string|max:255',
                'father_middle_name' => 'nullable|string|max:255',
                'father_last_name' => 'nullable|string|max:255',
                'father_citizenship' => 'nullable|string|max:255',
                'father_religion' => 'nullable|string|max:255',
                'father_occupation' => 'nullable|string|max:255',
                'father_age_at_birth' => 'nullable|integer|min:0',
                'father_residence' => 'nullable|string|max:500',
                'father_address' => 'nullable|string|max:500',
                
                // Marriage Information
                'parents_marriage_date' => 'nullable|date',
                'parents_marriage_place' => 'nullable|string|max:255',
                
                // Birth Attendant Information
                'attendant_name' => 'nullable|string|max:255',
                'attendant_type' => 'nullable|in:Doctor,Midwife,Nurse,Hilot,Others',
                'attendant_title' => 'nullable|string|max:255',
                
                // Registration Information
                'date_registered' => 'nullable|date',
                'registered_by' => 'nullable|string|max:255',
                'registrar_name' => 'nullable|string|max:255',

                'status' => 'required|in:Draft,Registered,Issued',
            ]);

            // Generate registry number if status is Registered or Issued
            if (in_array($validated['status'], ['Registered', 'Issued'])) {
                $validated['registry_number'] = BirthCertificate::generateRegistryNumber();
                
                // Set registration date if not provided
                if (!$validated['date_registered']) {
                    $validated['date_registered'] = now()->format('Y-m-d');
                }
                
                // Set registered by if not provided
                if (!$validated['registered_by']) {
                    $validated['registered_by'] = auth()->user()->firstname . ' ' . auth()->user()->lastname;
                }
            }

            BirthCertificate::create($validated);

            return redirect()->route('staff.birth-certificates.index')
                ->with('success', 'Birth Certificate created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating birth certificate: ' . $e->getMessage())->withInput();
        }
    }

    public function show(BirthCertificate $birthCertificate)
    {
        return view('staff.birth-certificates.show', compact('birthCertificate'));
    }

    public function edit(BirthCertificate $birthCertificate)
    {
        return view('staff.birth-certificates.edit', compact('birthCertificate'));
    }

    public function update(Request $request, BirthCertificate $birthCertificate)
    {
        try {
            $validated = $request->validate([
                // Child Information
                'child_first_name' => 'required|string|max:255',
                'child_middle_name' => 'nullable|string|max:255',
                'child_last_name' => 'required|string|max:255',
                'child_sex' => 'required|in:Male,Female',
                'date_of_birth' => 'required|date',
                'time_of_birth' => 'required',
                'place_of_birth' => 'required|string|max:255',
                'birth_weight' => 'nullable|numeric|min:0',
                'birth_length' => 'nullable|numeric|min:0',
                'birth_order' => 'nullable|integer|min:1',
                'multiple_birth' => 'nullable|in:Single,Twin,Triplet,Other',
                
                // Mother Information
                'mother_first_name' => 'required|string|max:255',
                'mother_middle_name' => 'nullable|string|max:255',
                'mother_last_name' => 'required|string|max:255',
                'mother_citizenship' => 'nullable|string|max:255',
                'mother_religion' => 'nullable|string|max:255',
                'mother_occupation' => 'nullable|string|max:255',
                'mother_age_at_birth' => 'nullable|integer|min:0',
                'mother_residence' => 'nullable|string|max:500',
                'mother_address' => 'nullable|string|max:500',
                
                // Father Information
                'father_first_name' => 'nullable|string|max:255',
                'father_middle_name' => 'nullable|string|max:255',
                'father_last_name' => 'nullable|string|max:255',
                'father_citizenship' => 'nullable|string|max:255',
                'father_religion' => 'nullable|string|max:255',
                'father_occupation' => 'nullable|string|max:255',
                'father_age_at_birth' => 'nullable|integer|min:0',
                'father_residence' => 'nullable|string|max:500',
                'father_address' => 'nullable|string|max:500',
                
                // Marriage Information
                'parents_marriage_date' => 'nullable|date',
                'parents_marriage_place' => 'nullable|string|max:255',
                
                // Birth Attendant Information
                'attendant_name' => 'nullable|string|max:255',
                'attendant_type' => 'nullable|in:Doctor,Midwife,Nurse,Hilot,Others',
                'attendant_title' => 'nullable|string|max:255',
                
                // Registration Information
                'date_registered' => 'nullable|date',
                'registered_by' => 'nullable|string|max:255',
                'registrar_name' => 'nullable|string|max:255',

                'status' => 'required|in:Draft,Registered,Issued',
            ]);

            // Generate registry number if status changed to Registered or Issued and no registry number exists
            if (in_array($validated['status'], ['Registered', 'Issued']) && !$birthCertificate->registry_number) {
                $validated['registry_number'] = BirthCertificate::generateRegistryNumber();
                
                // Set registration date if not provided
                if (!$validated['date_registered']) {
                    $validated['date_registered'] = now()->format('Y-m-d');
                }
                
                // Set registered by if not provided
                if (!$validated['registered_by']) {
                    $validated['registered_by'] = auth()->user()->firstname . ' ' . auth()->user()->lastname;
                }
            }

            $birthCertificate->update($validated);

            return redirect()->route('staff.birth-certificates.index')
                ->with('success', 'Birth Certificate updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating birth certificate: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(BirthCertificate $birthCertificate)
    {
        try {
            $birthCertificate->delete();
            return redirect()->route('staff.birth-certificates.index')
                ->with('success', 'Birth Certificate deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting birth certificate: ' . $e->getMessage());
        }
    }
}
