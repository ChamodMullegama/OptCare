<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\EyeHospital;
use Illuminate\Http\Request;

class PublicEyeHospitalController extends Controller
{
    public function All()
    {
        $hospitals = EyeHospital::all();
        return view('PublicArea.Pages.Hospitals.index', compact('hospitals'));
    }

    public function Search(Request $request)
    {
        $search = $request->input('search');

        $hospitals = EyeHospital::where('hospital_name', 'like', '%' . $search . '%')
            ->orWhere('location', 'like', '%' . $search . '%')
            ->orWhere('address', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();

        return view('PublicArea.Pages.Hospitals.index', compact('hospitals', 'search'));
    }

    public function Details($hospitalId)
    {
        $hospital = EyeHospital::where('hospitalId', $hospitalId)->firstOrFail();
        $recentHospitals = EyeHospital::where('hospitalId', '!=', $hospitalId)->latest()->take(5)->get();
        return view('PublicArea.Pages.Hospitals.details', compact('hospital', 'recentHospitals'));
    }
}
