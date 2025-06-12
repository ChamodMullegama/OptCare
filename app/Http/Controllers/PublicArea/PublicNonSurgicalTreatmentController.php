<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\NonSurgicalTreatment;
use domain\Facades\AdminArea\NonSurgicalTreatmentFacade;
use Illuminate\Http\Request;

class PublicNonSurgicalTreatmentController extends Controller
{
   public function All()
    {
        $treatments = NonSurgicalTreatment::all();
        return view('PublicArea.Pages.Treatments.nonSurgicalTreatment', compact('treatments'));
    }

    public function Search(Request $request)
    {
        $search = $request->input('search');

        $treatments = NonSurgicalTreatment::where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();

        return view('PublicArea.Pages.Treatments.nonSurgicalTreatment', compact('treatments', 'search'));
    }

    public function Show($id)
    {
        $treatment = NonSurgicalTreatment::findOrFail($id);
        $recentTreatments = NonSurgicalTreatment::where('id', '!=', $id)->latest()->take(5)->get();
        return view('PublicArea.Pages.Treatments.nonSurgicalTreatmentDetails', compact('treatment', 'recentTreatments'));
    }
}
