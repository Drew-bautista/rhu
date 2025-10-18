<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function testAuth()
    {
        if (Auth::check()) {
            return response()->json([
                'authenticated' => true,
                'user' => Auth::user()->email,
                'role' => Auth::user()->role,
                'message' => 'User is authenticated'
            ]);
        } else {
            return response()->json([
                'authenticated' => false,
                'message' => 'User is not authenticated'
            ]);
        }
    }
}
