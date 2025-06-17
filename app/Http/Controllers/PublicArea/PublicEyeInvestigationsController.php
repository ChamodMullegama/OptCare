<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\EyeScan;
use domain\Facades\PublicArea\EyeInvestigationsFacade;
use Illuminate\Http\Request;

class PublicEyeInvestigationsController extends Controller
{
      public function All()
    {
        $EyeScans = EyeInvestigationsFacade::all();
        return view('PublicArea.Pages.EyeInvestigations.index', compact('EyeScans'));
    }

   public function Search(Request $request)
{
    $search = $request->input('search');
    $EyeScans = EyeInvestigationsFacade::search($search ?? '');
    return view('PublicArea.Pages.EyeInvestigations.index', compact('EyeScans', 'search'));
}

    public function Details($eyeScanId)
    {
        $EyeScan = EyeInvestigationsFacade::getDetails($eyeScanId);
        $recentEyeScans = EyeInvestigationsFacade::getRecentEyeScans($eyeScanId);
        return view('PublicArea.Pages.EyeInvestigations.Details', compact('EyeScan', 'recentEyeScans'));
    }
}
