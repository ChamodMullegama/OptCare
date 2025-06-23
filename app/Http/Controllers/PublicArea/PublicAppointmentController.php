<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;
use domain\Facades\PublicArea\DoctorFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicAppointmentController extends Controller
{

    public function Appointment()
    {
        try {
            $doctors = DoctorFacade::all();
            return view('PublicArea.Pages.Appointment.index', compact('doctors'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

     public function Details($id)
    {
        try {
            $doctor = DoctorFacade::getDetails($id);


            return view('PublicArea.Pages.Appointment.doctorDetails', compact('doctor'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Doctor not found');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load doctor details. Please try again.');
        }
    }



public function appointmentsearch(Request $request)
{
    try {
        $query = Doctor::query();
        $searchParams = [];

        if ($request->isMethod('post')) {
            $request->validate([
                'doctor_name' => 'nullable|string|max:255',
                'date' => 'required|date|after_or_equal:today',
                'time' => 'required|date_format:H:i',
            ]);

            $searchDate = $request->input('date');
            $searchTime = $request->input('time');
            $doctorName = $request->input('doctor_name');

            // Filter by doctor name if provided
            if ($request->filled('doctor_name')) {
                $query->where(function ($q) use ($doctorName) {
                    $q->where('first_name', 'like', "%{$doctorName}%")
                      ->orWhere('last_name', 'like', "%{$doctorName}%")
                      ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$doctorName}%"]);
                });
            }

            // Check availability by excluding doctors who already have appointments
            // at the specified date and time
            $conflictingDoctorIds = Appointment::where('date', $searchDate)
                ->where('time', $searchTime)
                ->whereIn('status', ['pending', 'accepted', 'completed']) // Exclude canceled appointments
                ->pluck('doctorId')
                ->toArray();

            if (!empty($conflictingDoctorIds)) {
                $query->whereNotIn('doctorId', $conflictingDoctorIds);
            }

                                    // Check doctor's availability schedule
            if (!empty($searchDate) && !empty($searchTime)) {
                $dayOfWeek = strtolower(Carbon::parse($searchDate)->format('l')); // Get day name (monday, tuesday, etc.)

                // Get all doctors and filter them manually for availability
                $availableDoctorIds = collect();

                // First get all doctors to check their availability
                $allDoctors = Doctor::select('id', 'doctorId', 'availability')->get();

                foreach ($allDoctors as $doctor) {
                    if ($this->isDoctorAvailableAt($doctor, $dayOfWeek, $searchTime)) {
                        $availableDoctorIds->push($doctor->doctorId);
                    }
                }

                // Filter the query to only include available doctors
                if ($availableDoctorIds->isNotEmpty()) {
                    $query->whereIn('doctorId', $availableDoctorIds->toArray());
                } else {
                    // No doctors available at this time, return empty results
                    $query->where('id', '=', 0); // This will return no results
                }
            }
        }

        $doctors = $query->get();

        // Pass search parameters back to view for maintaining form state
        if ($request->isMethod('post')) {
            $searchParams = [
                'doctor_name' => $request->input('doctor_name'),
                'date' => $request->input('date'),
                'time' => $request->input('time')
            ];
        }

        return view('PublicArea.Pages.Appointment.index', compact('doctors', 'searchParams'));
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()])->withInput();
    }
}

    public function BookAppointment(Request $request)
    {
        

        try {
        // Check if user is logged in by verifying customer_id in session
        $userId = session('customer_id');

        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'Please log in to book an appointment']);
        }

        // Validate request data (optional, but recommended)
        $request->validate([
            'doctorId' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
            'message' => 'nullable|string',
        ]);

        // Save appointment
        Appointment::create([
            'appointmentId' => 'AP' . Str::random(6),
            'doctorId' => $request->input('doctorId'),
            'user_id' => $userId,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with('success', 'Appointment booked successfully!');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Failed to book appointment: ' . $e->getMessage()]);
    }
    }

    /**
     * Check if a doctor is available at a specific day and time
     */
    private function isDoctorAvailableAt($doctor, $dayOfWeek, $searchTime)
    {
        // If availability is null, assume doctor is available all times
        if (is_null($doctor->availability)) {
            return true;
        }

        // Decode the availability JSON
        $availability = json_decode($doctor->availability, true);

        // Check if the day exists in availability
        if (!isset($availability[$dayOfWeek])) {
            return false;
        }

        $daySchedule = $availability[$dayOfWeek];

        // Check each time range for this day
        foreach ($daySchedule as $timeRange) {
            if ($this->isTimeInRange($searchTime, $timeRange)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if a time falls within a time range
     */
    private function isTimeInRange($time, $timeRange)
    {
        // Handle different time range formats
        if (strpos($timeRange, '-') !== false) {
            // Range format like "09:00-17:00"
            list($startTime, $endTime) = explode('-', $timeRange);

            $searchTimeCarbon = Carbon::createFromFormat('H:i', $time);
            $startTimeCarbon = Carbon::createFromFormat('H:i', trim($startTime));
            $endTimeCarbon = Carbon::createFromFormat('H:i', trim($endTime));

            return $searchTimeCarbon->between($startTimeCarbon, $endTimeCarbon);
        } else {
            // Exact time format like "09:00"
            return trim($timeRange) === $time;
        }
    }
}
