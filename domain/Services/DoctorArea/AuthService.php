<?php

namespace domain\Services\DoctorArea;

use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function attemptLogin($email, $password)
    {
        $doctor = Doctor::where('email', $email)->first();

        if (!$doctor || !Hash::check($password, $doctor->password)) {
            return false;
        }

        Auth::guard('doctor')->login($doctor);
        return true;
    }

    public function logout()
    {
        Auth::guard('doctor')->logout();
    }

    public function getCurrentDoctor()
    {
        return Auth::guard('doctor')->user();
    }
}
