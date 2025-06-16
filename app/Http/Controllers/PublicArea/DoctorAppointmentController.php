<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use domain\Facades\PublicArea\DoctorFacade;
use Illuminate\Http\Request;

class DoctorAppointmentController extends Controller
{
         public function All()
    {
        try {
            $doctors = DoctorFacade::all();
            return view('PublicArea.Pages.Appointment.index', compact('doctors'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load doctors. Please try again.');
        }
    }
}
