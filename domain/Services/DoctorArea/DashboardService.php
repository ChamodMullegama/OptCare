<?php

namespace domain\Services\DoctorArea;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorReview;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardService
{
    protected $doctor;
    protected $appointment;
    protected $doctorReview;

    public function __construct()
    {
        $this->doctor = new Doctor();
        $this->appointment = new Appointment();
        $this->doctorReview = new DoctorReview();
    }

    public function getDashboardData()
    {
        try {
            // Get the authenticated doctor's ID from session
            $doctorId = Session::get('doctor.doctorId');

            // Check if doctor is authenticated
            if (!$doctorId) {
                throw new \Exception('Please login first');
            }

            // Fetch doctor details
            $doctor = $this->doctor->where('doctorId', $doctorId)->firstOrFail();

            // Fetch appointment counts
            $totalAppointments = $this->appointment->where('doctorId', $doctorId)->count();
            $completedAppointments = $this->appointment->where('doctorId', $doctorId)
                ->where('status', 'completed')
                ->count();
            $dueAppointments = $this->appointment->where('doctorId', $doctorId)
                ->whereIn('status', ['pending', 'accepted'])
                ->where('date', '>=', Carbon::today()->toDateString())
                ->count();

            // Fetch total reviews
            $totalReviews = $this->doctorReview->where('doctorId', $doctorId)->count();

            // Fetch today's appointments
            $todayAppointments = $this->appointment->where('doctorId', $doctorId)
                ->where('date', Carbon::today()->toDateString())
                ->orderBy('time', 'asc')
                ->get();

            // Fetch due appointments
            $dueAppointmentsList = $this->appointment->where('doctorId', $doctorId)
                ->whereIn('status', ['pending', 'accepted'])
                ->where('date', '>=', Carbon::today()->toDateString())
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc')
                ->get();

            // Fetch latest 3 reviews
            $latestReviews = $this->doctorReview->where('doctorId', $doctorId)
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();

            // Fetch appointment status counts for Donut chart
            $appointmentStatuses = $this->appointment->where('doctorId', $doctorId)
                ->select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();

            // Fetch daily appointments for past 7 days for Bar Graph
            $dailyAppointments = $this->appointment->where('doctorId', $doctorId)
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
            $dailyReviews = $this->doctorReview->where('doctorId', $doctorId)
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
                'lineGraphCounts'
            ));
        } catch (\Exception $e) {
            throw new \Exception('Failed to load dashboard data: ' . $e->getMessage());
        }
    }
}
