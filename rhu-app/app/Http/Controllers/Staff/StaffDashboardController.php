<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $totalPatients = Appointment::where('status', 'completed')->count();
        $totalAppointments = Appointment::where('status', 'pending')->count();
        $totalStaff = User::where('role', 'staff')->count();
        $appointments = Appointment::where('status', 'pending')->orderBy('date_of_appointment', 'asc')->get();

        return view('staff.index', compact('totalPatients', 'totalAppointments', 'totalStaff', 'appointments'));
    }
}
