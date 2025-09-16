<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle admin login attempt.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Try authentication with email first, then name (for backward compatibility)
        $credentials1 = [
            'email' => $request->username,
            'password' => $request->password,
        ];
        
        $credentials2 = [
            'name' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials1) || Auth::attempt($credentials2)) {
            // Check if the authenticated user is an admin
            if (!Auth::user()->is_admin) {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Invalid login credentials.',
                ])->onlyInput('username');
            }
            
            $request->session()->regenerate();
            return redirect('/admin/dashboard');
        }

        return back()->withErrors([
            'username' => 'Invalid login credentials.',
        ])->onlyInput('username');
    }

    /**
     * Handle admin logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/admin/login');
    }

    /**
     * Show admin dashboard.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}