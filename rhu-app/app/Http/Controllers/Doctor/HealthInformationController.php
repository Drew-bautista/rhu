<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\HealthInformation;
use Illuminate\Http\Request;

class HealthInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $healthInformation = HealthInformation::with('patientAppointment')->get();
        // dd($healthInformation);
        $appointments = Appointment::all();
        return view('admin.patient-record.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $id)
    {
        $healthInformation = HealthInformation::with('birthingPatient')->findOrFail($id);
        return view('admin.patient-record.show', compact('healthInformation'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $healthInformation = HealthInformation::with('patientAppointment')->find($id);


        return view('admin.patient-record.show', compact('healthInformation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
