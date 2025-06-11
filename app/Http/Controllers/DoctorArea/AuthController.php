<?php

namespace App\Http\Controllers\DoctorArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use domain\Facades\DoctorArea\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('DoctorArea.Pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attemptLogin($credentials['email'], $credentials['password'])) {
            return redirect()->intended(route('doctor.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('doctor.login');
    }
}
