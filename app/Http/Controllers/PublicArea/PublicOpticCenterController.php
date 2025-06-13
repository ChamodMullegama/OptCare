<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\OpticCenter;
use domain\Facades\PublicArea\OpticCenterFacade;
use Illuminate\Http\Request;

class PublicOpticCenterController extends Controller
{
        public function All()
    {
        try {
            $opticCenters = OpticCenterFacade::all();
            return view('PublicArea.Pages.OpticCenters.index', compact('opticCenters'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load optic centers. Please try again.');
        }
    }

    public function Search(Request $request)
    {
        try {
            $search = $request->input('search');
            $opticCenters = OpticCenterFacade::search($search);
            return view('PublicArea.Pages.OpticCenters.index', compact('opticCenters', 'search'));
        } catch (\Exception $e) {
            return back()->with('error', 'Search failed. Please try again.');
        }
    }

    public function Details($hospitalId)
    {
        try {
            $opticCenter = OpticCenterFacade::getDetails($hospitalId);
            $recentOpticCenters = OpticCenterFacade::getRecentCenters($hospitalId);
            return view('PublicArea.Pages.OpticCenters.Details', compact('opticCenter', 'recentOpticCenters'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Optic center not found');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load center details. Please try again.');
        }
    }
}
