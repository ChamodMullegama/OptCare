<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\SurgicalTreatment;
use domain\Facades\PublicArea\SurgicalTreatmentFacade;
use Illuminate\Http\Request;

class PublicSurgicalTreatmentController extends Controller
{
    public function All()
    {
        try {
            $treatments = SurgicalTreatmentFacade::all();
            return view('PublicArea.Pages.Treatments.surgicalTreatment', compact('treatments'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load surgical treatments. Please try again.');
        }
    }

    public function Search(Request $request)
    {
        try {
            $search = $request->input('search');
            $treatments = SurgicalTreatmentFacade::search($search);
            return view('PublicArea.Pages.Treatments.surgicalTreatment', compact('treatments', 'search'));
        } catch (\Exception $e) {
            return back()->with('error', 'Search failed. Please try again.');
        }
    }

    public function Details($id)
    {
        try {
            $treatment = SurgicalTreatmentFacade::getDetails($id);
            $recentTreatments = SurgicalTreatmentFacade::getRecentTreatments($id);
            return view('PublicArea.Pages.Treatments.surgicalTreatmentDetails', compact('treatment', 'recentTreatments'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Surgical treatment not found');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load treatment details. Please try again.');
        }
    }
}
