<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class StaffAppointmentController extends Controller
{


    public function index()
    {
        $appointments = Appointment::all();
        return view('staff.appointments.index', compact('appointments'));
    }
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('staff.appointments.show', compact('appointment'));
    }

    public function create()
    {
        return view('staff.appointments.create-appointment');
    }


    public function store(Request $request)
    {

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer',
            'contact_number' => 'required|string|max:20',
            'date_of_appointment' => 'required|date',
            'time' => 'required',
            'address' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'emergency_contact' => 'required|digits:11',
            // 'status' => 'required|in:pending,completed,cancelled', // Ensure status is valid
        ]);

        // Create a new appointment
        // Appointment::create([
        //     'name' => $request->name,
        //     'date_of_birth' => $request->date_of_birth,
        //     'age' => $request->age,
        //     'contact_number' => $request->contact_number,
        //     'date_of_appointment' => $request->date_of_appointment,
        //     'time' => $request->time,
        //     'address' => $request->address,
        //     'service' => $request->service,
        //     'emergency_contact' => $request->emergency_contact,
        //     // 'status' => $request->status, // Include status
        // ]);


        Appointment::create($request->all());
        return redirect()->route('staff.appointments.index')->with('success', 'Appointment created successfully.');
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('staff.appointments.edit-appointment', compact('appointment'));
    }

    public function update(Request $request,  $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer',
            'contact_number' => 'required|string|max:20',
            'date_of_appointment' => 'required|date',
            'time' => 'required',
            'address' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'emergency_contact' => 'required|digits:11',
            'status' => 'required|in:pending,completed,cancelled',
        ]);


        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());

        // Redirect to the appointments index page with a success message
        return redirect()->route('staff.appointments.index')->with('success', 'Appointment updated successfully.');
    }
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('staff.appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}




// public function index()
// {
//     $appointments = Appointment::all();
//     return view('staff.appointments.index', compact('appointments'));
// }

// // Show the form for creating a new appointment
// public function create()
// {
//     return view('staff.appointments.create-appointment');
// }

// // Store a newly created appointment in the database
// public function store(Request $request)
// {
//     $request->validate([
//         'patient_name' => 'required|string|max:255',
//         // 'contact_info' => 'required|string|max:255',
//         'date_of_appointment' => 'required|date',
//         'weight' => 'required|numeric',
//         'age_of_gestation' => 'required|integer',
//         'blood_pressure' => 'required|string|max:255',
//         'nutritional_status' => 'required|in:normal,underweight,overweight',
//         'number_of_checkup' => 'required|in:first checkup,second checkup,third checkup',
//         // 'status' => 'required|in:pending,completed,cancelled',
//         'birth_plan' => 'required|string',
//         'dental_checkup' => 'required|string',
//     ]);

//     Appointment::create($request->all());

//     return redirect()->route('admin.appointments.index')
//         ->with('success', 'Appointment created successfully.');
// }

// // Display the specified appointment
// public function show(Appointment $appointment)
// {
//     return view('admin.appointments.show', compact('appointment'));
// }

// // Show the form for editing the specified appointment
// public function edit($id)
// {
//     $appointment = Appointment::findOrFail($id);
//     return view('admin.appointments.edit-appointment', compact('appointment'));
// }

// // Update the specified appointment in the database
// public function update(Request $request, Appointment $appointment)
// {
//     $request->validate([
//         'patient_name' => 'required|string|max:255',
//         'date_of_appointment' => 'required|date',
//         'weight' => 'required|numeric',
//         'age_of_gestation' => 'required|integer',
//         'blood_pressure' => 'required|string|max:255',
//         'nutritional_status' => 'required|in:normal,underweight,overweight',
//         'number_of_checkup' => 'required|in:first checkup,second checkup,third checkup',
//         'status' => 'required|in:pending,completed,cancelled',
//         'birth_plan' => 'required|string',
//         'dental_checkup' => 'required|string',
//     ]);

//     $appointment->update($request->only([
//         'patient_name',
//         'date_of_appointment',
//         'weight',
//         'age_of_gestation',
//         'blood_pressure',
//         'nutritional_status',
//         'number_of_checkup',
//         'birth_plan',
//         'dental_checkup',
//     ]));

//     return redirect()->route('admin.appointments.index')
//         ->with('success', 'Appointment updated successfully.');
// }


// // Remove the specified appointment from the database
// public function destroy(Appointment $appointment)
// {
//     $appointment->delete();

//     return redirect()->route('admin.appointments.index')
//         ->with('success', 'Appointment deleted successfully.');
// }























    // Display a listing of appointments
//     public function index()
//     {
//         $appointments = Appointment::all();
//         return view('admin.appointments.index', compact('appointments'));
//     }

//     // Show the form for creating a new appointment
//     public function create()
//     {
//         return view('admin.appointments.create-appointment');
//     }

//     // Store a newly created appointment
//     public function store(Request $request)
//     {
//         $request->validate([
//             'patient_name' => 'required|string',
//             'contact_info' => 'required|string',
//             'appointment_date' => 'required|date',
//             'appointment_time' => 'required|date_format:H:i',
//             'reason' => 'required|string',
//             // 'insurance_info' => 'nullable|string',
//             'doctor_name' => 'nullable|string',
//             'emergency_contact' => 'required|string',
//             'medical_history' => 'nullable|string',
//             'address' => 'required|string',
//             'gender' => 'required|string',
//         ]);


//         Appointment::create($request->all());

//         return redirect()->route('admin.appointments.index')
//             ->with('success', 'Appointment created successfully.');
//     }

//     // Display the specified appointment
//     public function show($id)
//     {
//         $appointment = Appointment::findOrFail($id);
//         return view('admin.appointments.show', compact('appointment'));
//     }

//     // Show the form for editing an appointment
//     public function edit($id)
//     {
//         $appointment = Appointment::findOrFail($id);
//         return view('admin.appointments.edit-appointment', compact('appointment'));
//     }

//     public function update(Request $request, $id)
//     {
//         $appointment = Appointment::findOrFail($id);

//         // $request->validate([
//         //     'patient_name' => 'sometimes|required|string|max:255',
//         //     'contact_info' => 'sometimes|required|string|max:255',
//         //     'appointment_date' => 'sometimes|required|date',
//         //     'appointment_time' => 'sometimes|required|date_format:H:i',
//         //     'address' => 'sometimes|required|string|max:255',
//         //     'sex' => 'sometimes|required|in:male,female',
//         //     'emergency_contact' => 'sometimes|required|string|max:255',
//         //     'doctor_name' => 'nullable|string|max:255',
//         //     'reason' => 'sometimes|required|string',
//         //     'medical_history' => 'nullable|string',
//         // ]);

//         // Gamitin ang $request->only() para kunin lang ang mga fields na may value
//         $data = $request->only([
//             'patient_name',
//             'contact_info',
//             'appointment_date',
//             'appointment_time',
//             'address',
//             'gender',
//             'emergency_contact',
//             'doctor_name',
//             'reason',
//             'medical_history',
//             'status',
//         ]);

//         $appointment->update($data);

//         return redirect()->route('admin.appointments.index')->with('success', 'Appointment updated successfully.');
//     }
//     // Delete the specified appointment
//     public function destroy($id)
//     {
//         $appointment = Appointment::findOrFail($id);
//         $appointment->delete();

//         return redirect()->route('admin.appointments.index')
//             ->with('success', 'Appointment deleted successfully.');
//     }
// }
