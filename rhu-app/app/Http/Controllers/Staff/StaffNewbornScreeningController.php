<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\NewbornScreening;
use Illuminate\Http\Request;

class StaffNewbornScreeningController extends Controller
{
    public function index()
    {
        $screenings = NewbornScreening::latest()->paginate(10);
        return view('staff.newborn_screenings.index', compact('screenings'));
    }




    public function show(NewbornScreening $newborn_screening)
    {
        return view('staff.newborn_screenings.show', compact('newborn_screening'));
    }
}
