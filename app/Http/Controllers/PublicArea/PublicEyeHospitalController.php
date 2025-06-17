<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\EyeHospital;
use domain\Facades\PublicArea\EyeHospitalFacade;
use Illuminate\Http\Request;

class PublicEyeHospitalController extends Controller
{
     public function All()
    {
        $hospitals = EyeHospitalFacade::all();
        return view('PublicArea.Pages.Hospitals.index', compact('hospitals'));
    }

    public function Search(Request $request)
    {
        $search = $request->input('search');
        $hospitals = EyeHospitalFacade::search($search);
        return view('PublicArea.Pages.Hospitals.index', compact('hospitals', 'search'));
    }

    public function Details($hospitalId)
    {
        $hospital = EyeHospitalFacade::getDetails($hospitalId);
        $recentHospitals = EyeHospitalFacade::getRecentHospitals($hospitalId);
        return view('PublicArea.Pages.Hospitals.details', compact('hospital', 'recentHospitals'));
    }
}
