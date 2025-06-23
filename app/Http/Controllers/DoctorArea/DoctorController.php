<?php

namespace App\Http\Controllers\DoctorArea;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorReview;
use Carbon\Carbon;
use Illuminate\Http\Request;
use domain\Facades\DoctorArea\Auth;
use domain\Facades\DoctorArea\DashboardFacade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function f()
    {
        return view('DoctorArea.Pages.Dashboard.index');
    }

    //  public function dashboard()
    // {
    //     // Get the authenticated doctor
    //     $doctor = Auth::getCurrentDoctor();

    //     // Check if doctor exists
    //     if (!$doctor) {
    //         return redirect()->route('doctor.login')->with('error', 'Please login first');
    //     }

    //     return view('DoctorArea.Pages.Dashboard.index', [
    //         'doctor' => $doctor
    //     ]);
    // }

    // public function index()
    // {
    //     return view('DoctorArea.Pages.Dashboard.index');
    // }

    public function dashboard()
    {
        try {
            return DashboardFacade::getDashboardData();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
