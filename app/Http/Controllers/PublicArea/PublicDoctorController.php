<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class PublicDoctorController extends Controller
{
    public function All()
    {
        $doctors = Doctor::all();
        return view('PublicArea.Pages.Doctor.index', compact('doctors'));
    }

    public function Search(Request $request)
    {
        $search = $request->input('search');

        $doctors = Doctor::where('first_name', 'like', '%'.$search.'%')
                        ->orWhere('last_name', 'like', '%'.$search.'%')
                        ->orWhere('qualification', 'like', '%'.$search.'%')
                        ->orWhere('designation', 'like', '%'.$search.'%')
                        ->get();

        return view('PublicArea.Pages.Doctor.index', compact('doctors', 'search'));
    }

    public function Details($id)
    {
        $doctor = Doctor::all()->findOrFail($id);
        return view('PublicArea.Pages.Doctor.details', compact('doctor'));
    }
}
