<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use PhpOption\None;
use Spatie\Permission\Models\Role;

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

            return redirect(route('dashboard'));
        } else {

            return back()->withErrors(['failed' => "Email or Password is Wrong!"]);
        }
    }

    // Logout user
    public function logout(Request $request)
    {
        // Logout
        Auth::logout();

        // Invalidate user's session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to login
        return redirect(route('login'));
    }

    // View register form
    public function index()
    {
        $roles = Role::all();

        return view('auth.register', ['roles' => $roles]);
    }

    // Register new user
    public function register(Request $request)
    {

        // User validation rules
        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
            'role' => ['required']
        ];

        // Add batch year validation only if the role is Student
        if ($request->role === 'Student') {
            $rules['batch_year'] = ['required', 'integer', 'min:1900', 'max:' . date('Y')];
        }

        // Validate the request
        $request->validate($rules);

        try {

            // Register
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'batch_year' => $request->batch_year ? $request->batch_year : null,
            ]);
            $user->assignRole($request->role);

            return back()->with('success', 'User Registered Successfully!');
        } catch (\Exception $e) {

            return back()->withErrors(['failed' => "Failed to Register User. Please Try Again."]);
        }
    }
}
