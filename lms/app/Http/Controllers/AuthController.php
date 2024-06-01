<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login user
    public function login(Request $request)
    {
        // Validate
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // Login 
        if (Auth::attempt($fields, $request->remember)) {
            return redirect(route('home'));
        } else {
            return back()->withErrors(['failed' => "Email or Password is Wrong!"]);
        }
    }
}
