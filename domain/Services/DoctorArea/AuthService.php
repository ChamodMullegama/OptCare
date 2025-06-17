<?php

namespace domain\Services\DoctorArea;

use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthService
{
     public function attemptLogin($email, $password)
    {
        $doctor = Doctor::where('email', $email)->first();

        if (!$doctor || !Hash::check($password, $doctor->password)) {
            return false;
        }

        Auth::guard('doctor')->login($doctor);

        // Store doctor data in session
        Session::put('doctor', [
            'name' => $doctor->first_name . ' ' . $doctor->last_name,
            'designation' => $doctor->designation,
            'image' => $doctor->profile_image,
                  'doctorId' => $doctor->doctorId,
                        'designation' => $doctor->designation
        ]);

        return true;
    }

    public function logout()
    {
        Auth::guard('doctor')->logout();
        Session::forget('doctor'); // Clear doctor session data
    }

    public function getCurrentDoctor()
    {
        return Auth::guard('doctor')->user();
    }
}
