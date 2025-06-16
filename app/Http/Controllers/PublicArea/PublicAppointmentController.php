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

        if ($request->isMethod('post')) {
            $request->validate([
                'doctor_name' => 'nullable|string|max:255',
                'date' => 'required|date|after_or_equal:today',
                'time' => 'required|date_format:H:i',
            ]);

            // Filter by doctor name
            if ($request->filled('doctor_name')) {
                $name = $request->input('doctor_name');
                $query->where(function ($q) use ($name) {
                    $q->where('first_name', 'like', "%{$name}%")
                      ->orWhere('last_name', 'like', "%{$name}%");
                });
            }

            // Get day name (e.g. "Monday")
            $date = Carbon::parse($request->input('date'));
            $day = $date->format('l');
            $time = $request->input('time');

            // MySQL JSON search - correct syntax
            $query->where(function($q) use ($day, $time) {
                $q->whereJsonContains("availability->$.{$day}", $time);
            });

            // Exclude doctors with existing appointments at this time
            $conflictingDoctors = Appointment::where('date', $date->format('Y-m-d'))
                ->where('time', $time)
                ->pluck('doctorId');

            $query->whereNotIn('doctorId', $conflictingDoctors);
        }

        $doctors = $query->get();

        return view('PublicArea.Pages.Appointment.index', compact('doctors'));
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    }
}

    public function BookAppointment(Request $request)
    {
        try {
            // Get user ID from session
            $userId = session('customer_id');

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
}
