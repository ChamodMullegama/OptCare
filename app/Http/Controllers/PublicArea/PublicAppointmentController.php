<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicAppointmentController extends Controller
{
      public function Appointment()
    {
        try {
            // $blogs = BlogFacade::allForPublic(); // Make sure this method exists in BlogService
            return view('PublicArea.Pages.Appointment.index');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
