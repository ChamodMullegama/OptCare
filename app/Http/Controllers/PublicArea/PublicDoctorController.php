<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorReview;
use domain\Facades\PublicArea\DoctorFacade;
use domain\Facades\PublicArea\ReviewFacade;
use Illuminate\Http\Request;

class PublicDoctorController extends Controller
{

     public function All()
    {
        try {
            $doctors = DoctorFacade::all();
            return view('PublicArea.Pages.Doctor.index', compact('doctors'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load doctors. Please try again.');
        }
    }

    public function Search(Request $request)
    {
        try {
            $search = $request->input('search');
            $doctors = DoctorFacade::search($search);
            return view('PublicArea.Pages.Doctor.index', compact('doctors', 'search'));
        } catch (\Exception $e) {
            return back()->with('error', 'Search failed. Please try again.');
        }
    }

    public function Details($id)
    {
        try {
            $doctor = DoctorFacade::getDetails($id);
            $doctor_reviews = DoctorReview::where('doctorId', $doctor->doctorId)->get();

            return view('PublicArea.Pages.Doctor.details', compact('doctor','doctor_reviews'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Doctor not found');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load doctor details. Please try again.');
        }
    }
}
