<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => 'required|in:doctor,nurse,staff,medtech,head,teacher,student',
            'birthdate' => 'required|date|before:today',
            'sex' => 'required|in:male,female,other',
            'contact_no' => 'required|string|max:20',
            'emergency_contact' => 'required|digits:11',
            'address' => 'required|string|max:500',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'birthdate' => $request->birthdate,
            'sex' => $request->sex,
            'contact_no' => $request->contact_no,
            'emergency_contact' => $request->emergency_contact,
            'address' => $request->address,
        ]);

        // Auto login after registration
        Auth::login($user);

        // Redirect based on user role
        if ($user->role === 'doctor') {
            return redirect('/doctor-dashboard');
        } elseif ($user->role === 'medtech') {
            return redirect('/doctor/cbc-results');
        } elseif ($user->role === 'staff') {
            return redirect('/staff-dashboard');
        } elseif ($user->role === 'nurse') {
            return redirect('/nurse-dashboard');
        } elseif ($user->role === 'head') {
            return redirect('/head-dashboard');
        } elseif ($user->role === 'teacher' || $user->role === 'student') {
            return redirect('/patient-dashboard');
        } else {
            return redirect('/dashboard');
        }
    }
}
