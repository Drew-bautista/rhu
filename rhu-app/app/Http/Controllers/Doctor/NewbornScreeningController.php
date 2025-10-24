<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewbornScreening;


class NewbornScreeningController extends Controller
{
    public function index()
    {
        $screenings = NewbornScreening::latest()->paginate(10);
        return view('admin.newborn_screenings.index', compact('screenings'));
    }

    public function create()
    {
        return view('admin.newborn_screenings.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'middle_name' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'last_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'sex' => 'required|in:Male,Female',
                'date_of_birth' => 'required|date|before_or_equal:today',
                'time_of_birth' => 'nullable|date_format:H:i',
                'birth_weight' => 'nullable|numeric|min:0.5|max:10',
                'gestational_age' => 'nullable|integer|min:20|max:45',
                'place_of_birth' => 'nullable|string|max:255',

                // Mother fields - separate first, middle, last names
                'mother_first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'mother_middle_name' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'mother_last_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'mother_age' => 'nullable|integer|min:12|max:60',
                'mother_address' => 'nullable|string|max:500',
                'mother_contact' => 'nullable|string|max:20|regex:/^[0-9+\-\s()]+$/',

                'screening_date' => 'required|date|before_or_equal:today',
                'facility' => 'nullable|string|max:255',
                'kit_no' => 'nullable|string|max:255',
                'sample_collection_at' => 'nullable|date|before_or_equal:today',
                'specimen_type' => 'nullable|string|max:255',

                'conditions_tested' => 'nullable|string|max:1000',
                'result_status' => 'required|in:Normal,Positive,Retest',
                'remarks' => 'nullable|string|max:1000',

                'provider_name' => 'nullable|string|max:255|regex:/^[a-zA-Z\s.]+$/',
                'provider_role' => 'nullable|string|max:255',
            ], [
                // Custom error messages
                'first_name.required' => 'Child\'s first name is required.',
                'first_name.regex' => 'Child\'s first name should only contain letters and spaces.',
                'last_name.required' => 'Child\'s last name is required.',
                'last_name.regex' => 'Child\'s last name should only contain letters and spaces.',
                'middle_name.regex' => 'Child\'s middle name should only contain letters and spaces.',
                'sex.required' => 'Please select the child\'s sex.',
                'sex.in' => 'Sex must be either Male or Female.',
                'date_of_birth.required' => 'Date of birth is required.',
                'date_of_birth.before_or_equal' => 'Date of birth cannot be in the future.',
                'time_of_birth.date_format' => 'Time of birth must be in HH:MM format (e.g., 14:30).',
                'birth_weight.numeric' => 'Birth weight must be a valid number.',
                'birth_weight.min' => 'Birth weight must be at least 0.5 kg.',
                'birth_weight.max' => 'Birth weight cannot exceed 10 kg.',
                'gestational_age.integer' => 'Gestational age must be a whole number.',
                'gestational_age.min' => 'Gestational age must be at least 20 weeks.',
                'gestational_age.max' => 'Gestational age cannot exceed 45 weeks.',
                
                'mother_first_name.required' => 'Mother\'s first name is required.',
                'mother_first_name.regex' => 'Mother\'s first name should only contain letters and spaces.',
                'mother_last_name.required' => 'Mother\'s last name is required.',
                'mother_last_name.regex' => 'Mother\'s last name should only contain letters and spaces.',
                'mother_middle_name.regex' => 'Mother\'s middle name should only contain letters and spaces.',
                'mother_age.integer' => 'Mother\'s age must be a valid number.',
                'mother_age.min' => 'Mother\'s age must be at least 12 years.',
                'mother_age.max' => 'Mother\'s age cannot exceed 60 years.',
                'mother_contact.regex' => 'Contact number should only contain numbers, spaces, +, -, and parentheses.',
                
                'screening_date.required' => 'Screening date is required.',
                'screening_date.before_or_equal' => 'Screening date cannot be in the future.',
                'sample_collection_at.before_or_equal' => 'Sample collection date cannot be in the future.',
                'result_status.required' => 'Please select a result status.',
                'result_status.in' => 'Result status must be Normal, Positive, or Retest.',
                'provider_name.regex' => 'Provider name should only contain letters, spaces, and periods.',
            ]);

            // If multiple conditions selected
            if ($request->has('conditions_tested')) {
                $validated['conditions_tested'] = $request->input('conditions_tested');
            }

            // Combine mother's name fields into single mother_name field
            $motherName = trim($validated['mother_first_name']);
            if (!empty($validated['mother_middle_name'])) {
                $motherName .= ' ' . trim($validated['mother_middle_name']);
            }
            $motherName .= ' ' . trim($validated['mother_last_name']);
            
            // Add the combined mother_name to validated data
            $validated['mother_name'] = $motherName;
            
            // Remove individual mother name fields as they're not in the database
            unset($validated['mother_first_name']);
            unset($validated['mother_middle_name']);
            unset($validated['mother_last_name']);
            
            // Ensure all required fields have values or set defaults
            $validated['birth_weight'] = $validated['birth_weight'] ?? null;
            $validated['gestational_age'] = $validated['gestational_age'] ?? null;
            $validated['place_of_birth'] = $validated['place_of_birth'] ?? null;
            $validated['mother_age'] = $validated['mother_age'] ?? null;
            $validated['mother_address'] = $validated['mother_address'] ?? null;
            $validated['mother_contact'] = $validated['mother_contact'] ?? null;
            $validated['facility'] = $validated['facility'] ?? null;
            $validated['kit_no'] = $validated['kit_no'] ?? null;
            $validated['sample_collection_at'] = $validated['sample_collection_at'] ?? null;
            $validated['specimen_type'] = $validated['specimen_type'] ?? null;
            $validated['conditions_tested'] = $validated['conditions_tested'] ?? null;
            $validated['remarks'] = $validated['remarks'] ?? null;
            $validated['provider_name'] = $validated['provider_name'] ?? null;
            $validated['provider_role'] = $validated['provider_role'] ?? null;

            NewbornScreening::create($validated);

            return redirect()->route('admin.newborn_screenings.index')->with('success', 'Newborn Screening Added!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating newborn screening: ' . $e->getMessage())->withInput();
        }
    }

    public function show(NewbornScreening $newborn_screening)
    {
        return view('admin.newborn_screenings.show', compact('newborn_screening'));
    }

    public function edit(NewbornScreening $newborn_screening)
    {
        return view('admin.newborn_screenings.edit', compact('newborn_screening'));
    }

    public function update(Request $request, NewbornScreening $newborn_screening)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'sex' => 'required|in:Male,Female',
                'date_of_birth' => 'required|date',
                'time_of_birth' => 'nullable',
                'birth_weight' => 'nullable|numeric',
                'gestational_age' => 'nullable|integer',
                'place_of_birth' => 'nullable|string|max:255',

                // Mother fields - using single name field as in form
                'mother_name' => 'required|string|max:255',
                'mother_age' => 'nullable|integer',
                'mother_address' => 'nullable|string|max:500',
                'mother_contact' => 'nullable|string|max:20',

                'screening_date' => 'required|date',
                'facility' => 'nullable|string|max:255',
                'kit_no' => 'nullable|string|max:255',
                'sample_collection_at' => 'nullable|date',
                'specimen_type' => 'nullable|string|max:255',

                'conditions_tested' => 'nullable|string|max:1000',
                'result_status' => 'required|in:Normal,Positive,Retest',
                'remarks' => 'nullable|string|max:1000',

                'provider_name' => 'nullable|string|max:255',
                'provider_role' => 'nullable|string|max:255',
            ]);

            $newborn_screening->update($validated);

            return redirect()->route('admin.newborn_screenings.index')
                ->with('success', 'Newborn Screening Updated Successfully!');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating record: ' . $e->getMessage())->withInput();
        }
    }


    public function destroy(NewbornScreening $newborn_screening)
    {
        $newborn_screening->delete();
        return redirect()->route('newborn_screenings.index')->with('success', 'Deleted Successfully!');
    }
}
