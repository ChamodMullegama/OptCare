<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use domain\Facades\AdminArea\EyeIssueFacade;
use Illuminate\Http\Request;

class PublicEyeIssueController extends Controller
{
    public function All()
{
    try {
        $eyeIssues = EyeIssueFacade::getAll();
        return view('PublicArea.Pages.EductionContent.eyeDisease', compact('eyeIssues'));
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    }
}

   public function Details($id)
    {
        try {
            $eyeIssue = EyeIssueFacade::findForPublic($id);
            $recentIssues = EyeIssueFacade::getRecent(3);
            return view('PublicArea.Pages.EductionContent.eyeDiseaseDetails', compact('eyeIssue', 'recentIssues'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

}
