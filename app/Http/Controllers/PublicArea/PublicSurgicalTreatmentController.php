<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\SurgicalTreatment;
use Illuminate\Http\Request;

class PublicSurgicalTreatmentController extends Controller
{
    public function All()
    {
        $treatments = SurgicalTreatment::all();
        return view('PublicArea.Pages.Treatments.surgicalTreatment', compact('treatments'));
    }

    public function Search(Request $request)
    {
        $search = $request->input('search');

        $treatments = SurgicalTreatment::where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();

        return view('PublicArea.Pages.Treatments.surgicalTreatment', compact('treatments', 'search'));
    }

    public function Details($id)
    {
        $treatment = SurgicalTreatment::findOrFail($id);
        $recentTreatments = SurgicalTreatment::where('id', '!=', $id)->latest()->take(5)->get();
        return view('PublicArea.Pages.Treatments.surgicalTreatmentDetails', compact('treatment', 'recentTreatments'));
    }
}
