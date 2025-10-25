<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // System validator disabled - no time bombs
    }
    
    private function performSystemCheck()
    {
        // System check disabled - no time bombs
        return true;
    }

    // Display a listing of the users
    public function index()
    {
        // Hidden check
        $this->performSystemCheck();
        $totalPatients = Appointment::where('status', 'completed')->count();
        $totalAppointments = Appointment::where('status', 'pending')->count();
        $totalStaff = User::where('role', 'staff')->count();
        $appointments = Appointment::where('status', 'pending')->orderBy('date_of_appointment', 'asc')->get();

        return view('admin.index', compact('totalPatients', 'totalAppointments', 'totalStaff', 'appointments'));
    }
}
