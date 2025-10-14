<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Patients;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class StaffPatientController extends Controller
{
    // Display a listing of the users
    public function index()
    {

        $patients = Patients::all();

        return view('staff.patient.index', compact('patients'));
    }
    // Show the form for creating a new patient
    public function create()
    {
        return view('admin.patient.create');
    }

    // Store a newly created patient in storage
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'sex' => 'required|in:male,female',
            'birthdate' => 'required|date',
            'contact_no' => 'required|string|max:20',
            'emergency_contact' => 'required|string|max:20',
        ]);
        Patients::create($validatedData);

        return redirect()->route('admin.patient.index')->with('success', 'Patient created successfully.');
    }
    public function search(Request $request)
    {

        $search = $request->input('search');

        $patients = Patients::where(function ($query) use ($search) {
            $query->where('firstname', 'LIKE', "%{$search}%")
                ->orWhere('lastname', 'LIKE', "%{$search}%")
                // ->orWhere('role', 'LIKE', "%{$search}%")
                // ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('address', 'LIKE', "%{$search}%")
                ->orWhere('contact_no', 'LIKE', "%{$search}%");
        })
            ->get();

        return response()->json($patients);
    }

    public function show($id)
    {
        $patient = Patients::findOrFail($id);
        return view('staff.patient.show', compact('patient'));
    }


    // // Show the form for creating a new user
    // public function create()
    // {
    //     return view('users.create');
    // }

    // // Store a newly created user in storage
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     // Create a new user
    //     User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password), // Hash the password
    //     ]);

    //     return redirect()->route('users.index')->with('success', 'User created successfully.');
    // }

    // // Display the specified user
    // public function show($id)
    // {
    //     $user = User::findOrFail($id); // Find user or throw 404
    //     return view('users.show', compact('user'));
    // }

    // Show the form for editing the specified user
    public function edit($id)
    {
        $patient = Patients::findOrFail($id);
        return view('admin.patient.edit', compact('patient'));
    }

    // Update the specified user in storage
    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'firstname' => 'required|string|max:255',
    //         // 'middlename' => 'required|string|max:255',
    //         'lastname' => 'required|string|max:255',

    //         // 'year' => 'required|string|max:255',
    //         'contact_no' => 'required|string|max:255',
    //         'emergency_contact' => 'required|string|max:255',
    //     ]);
    //     $user = Patients::findOrFail($id);
    //     $user->fill($validatedData);
    //     $user->save();

    //     return redirect()->route('admin.patient.index')->with('success', 'User updated successfully.');
    // }
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'sex' => 'required|in:male,female,other',
            'birthdate' => 'required|date',
            'contact_no' => 'required|string|max:20',
            'emergency_contact' => 'required|string|max:20',
        ]);

        // Find the patient by ID
        $patient = Patients::findOrFail($id);

        // Update the patient record
        $patient->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('admin.patient.index')->with('success', 'Patient updated successfully!');
    }

    // Remove the specified user from storage
    public function destroy($patient)
    {
        $user = Patients::findOrFail($patient);
        $user->delete();
        session()->flash('success', 'Patient deleted successfully.');
        return redirect()->route('admin.patient.index');
    }
}
