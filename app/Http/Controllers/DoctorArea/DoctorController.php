<?php

namespace App\Http\Controllers\DoctorArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use domain\Facades\DoctorArea\Auth;

class DoctorController extends Controller
{
    public function f()
    {
        return view('DoctorArea.Pages.Dashboard.index');
    }

     public function dashboard()
    {
        // Get the authenticated doctor
        $doctor = Auth::getCurrentDoctor();

        // Check if doctor exists
        if (!$doctor) {
            return redirect()->route('doctor.login')->with('error', 'Please login first');
        }

        return view('DoctorArea.Pages.Dashboard.index', [
            'doctor' => $doctor
        ]);
    }

    // public function index()
    // {
    //     return view('DoctorArea.Pages.Dashboard.index');
    // }
}
