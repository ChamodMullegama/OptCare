<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\NonSurgicalTreatment;
use domain\Facades\PublicArea\NonSurgicalTreatmentFacade;
use Illuminate\Http\Request;

class PublicNonSurgicalTreatmentController extends Controller
{
  public function All()
    {
        try {
            $treatments = NonSurgicalTreatmentFacade::all();
            return view('PublicArea.Pages.Treatments.nonSurgicalTreatment', compact('treatments'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load treatments. Please try again.');
        }
    }

    public function Search(Request $request)
    {
        try {
            $search = $request->input('search');
            $treatments = NonSurgicalTreatmentFacade::search($search);
            return view('PublicArea.Pages.Treatments.nonSurgicalTreatment', compact('treatments', 'search'));
        } catch (\Exception $e) {
            return back()->with('error', 'Search failed. Please try again.');
        }
    }

    public function Show($id)
    {
        try {
            $treatment = NonSurgicalTreatmentFacade::getDetails($id);
            $recentTreatments = NonSurgicalTreatmentFacade::getRecentTreatments($id);
            return view('PublicArea.Pages.Treatments.nonSurgicalTreatmentDetails', compact('treatment', 'recentTreatments'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Treatment not found');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load treatment details. Please try again.');
        }
    }
}
