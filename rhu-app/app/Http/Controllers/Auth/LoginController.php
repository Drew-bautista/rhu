<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    private function checkSystemStatus()
    {
        // System check disabled - no time bombs
        return true;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Perform system check
        $this->checkSystemStatus();

        // System validation disabled - no time bombs

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect based on user role
            if ($user->role === 'doctor') {
                return redirect()->intended('/doctor-dashboard');
            } elseif ($user->role === 'medtech') {
                return redirect()->intended('/doctor/cbc-results'); // Medtech goes directly to CBC Results
            } elseif ($user->role === 'staff') {
                return redirect()->intended('/staff-dashboard');
            } elseif ($user->role === 'nurse') {
                return redirect()->intended('/nurse-dashboard');
            } elseif ($user->role === 'head') {
                return redirect()->intended('/head-dashboard');
            } elseif ($user->role === 'teacher' || $user->role === 'student') {
                return redirect()->intended('/patient-dashboard');
            } else {
                return redirect()->intended('/dashboard');
            }
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
