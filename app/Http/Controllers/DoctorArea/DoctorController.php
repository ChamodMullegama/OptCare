<?php

namespace App\Http\Controllers\DoctorArea;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorReview;
use Carbon\Carbon;
use Illuminate\Http\Request;
use domain\Facades\DoctorArea\Auth;

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
            // Get the authenticated doctor's ID from session
            $doctorId = Session::get('doctor.doctorId');

            // Check if doctor is authenticated
            if (!$doctorId) {
                return redirect()->route('doctor.login')->with('error', 'Please login first');
            }

            // Fetch doctor details
            $doctor = Doctor::where('doctorId', $doctorId)->firstOrFail();

            // Fetch appointment counts
            $totalAppointments = Appointment::where('doctorId', $doctorId)->count();
            $completedAppointments = Appointment::where('doctorId', $doctorId)
                                               ->where('status', 'completed')
                                               ->count();
            $dueAppointments = Appointment::where('doctorId', $doctorId)
                                         ->whereIn('status', ['pending', 'accepted'])
                                         ->where('date', '>=', Carbon::today()->toDateString())
                                         ->count();

            // Fetch total reviews
            $totalReviews = DoctorReview::where('doctorId', $doctorId)->count();

            // Fetch today's appointments
            $todayAppointments = Appointment::where('doctorId', $doctorId)
                                           ->where('date', Carbon::today()->toDateString())
                                           ->orderBy('time', 'asc')
                                           ->get();

            // Fetch due appointments
            $dueAppointmentsList = Appointment::where('doctorId', $doctorId)
                                             ->whereIn('status', ['pending', 'accepted'])
                                             ->where('date', '>=', Carbon::today()->toDateString())
                                             ->orderBy('date', 'asc')
                                             ->orderBy('time', 'asc')
                                             ->get();

            // Fetch latest 3 reviews
            $latestReviews = DoctorReview::where('doctorId', $doctorId)
                                        ->orderBy('created_at', 'desc')
                                        ->take(3)
                                        ->get();

            // Fetch appointment status counts for Donut chart
            $appointmentStatuses = Appointment::where('doctorId', $doctorId)
                ->select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();

            // Fetch daily appointments for past 7 days for Bar Graph
            $dailyAppointments = Appointment::where('doctorId', $doctorId)
                ->where('date', '>=', Carbon::today()->subDays(6))
                ->select(DB::raw('DATE(date) as date'), DB::raw('count(*) as count'))
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get()
                ->pluck('count', 'date')
                ->toArray();

            // Prepare dates and counts for Bar Graph
            $barGraphDates = [];
            $barGraphCounts = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i)->toDateString();
                $barGraphDates[] = Carbon::parse($date)->format('M d');
                $barGraphCounts[] = isset($dailyAppointments[$date]) ? $dailyAppointments[$date] : 0;
            }

            // Fetch review counts for past 30 days for Line Graph
            $dailyReviews = DoctorReview::where('doctorId', $doctorId)
                ->where('created_at', '>=', Carbon::today()->subDays(29))
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get()
                ->pluck('count', 'date')
                ->toArray();

            // Prepare dates and counts for Line Graph
            $lineGraphDates = [];
            $lineGraphCounts = [];
            for ($i = 29; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i)->toDateString();
                $lineGraphDates[] = Carbon::parse($date)->format('M d');
                $lineGraphCounts[] = isset($dailyReviews[$date]) ? $dailyReviews[$date] : 0;
            }

            // Fetch patient gender distribution for Pie chart (assuming gender field exists)
            // $patientGenders = Appointment::where('doctorId', $doctorId)
            //     ->select('gender', DB::raw('count(*) as count'))
            //     ->groupBy('gender')
            //     ->pluck('count', 'gender')
            //     ->toArray();

            return view('DoctorArea.Pages.Dashboard.index', compact(
                'doctor',
                'totalAppointments',
                'completedAppointments',
                'dueAppointments',
                'totalReviews',
                'todayAppointments',
                'dueAppointmentsList',
                'latestReviews',
                'appointmentStatuses',
                'barGraphDates',
                'barGraphCounts',
                'lineGraphDates',
                'lineGraphCounts',

            ));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
