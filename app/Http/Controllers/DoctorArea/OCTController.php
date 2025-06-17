<?php

namespace App\Http\Controllers\DoctorArea;

use App\Http\Controllers\Controller;
use domain\Facades\DoctorArea\OctFacade;
use Illuminate\Http\Request;

class OCTController extends Controller
{
    public function showPatients()
    {
        return OctFacade::showPatients();
    }

    public function showUploadForm(Request $request)
    {
        return OctFacade::showUploadForm($request);
    }

    public function uploadAndPredict(Request $request)
    {
        return OctFacade::uploadAndPredict($request);
    }

    public function viewAnalysis($id)
    {
        return OctFacade::viewAnalysis($id);
    }

    public function downloadAnalysis($id)
    {
        return OctFacade::downloadAnalysis($id);
    }

    public function deleteAnalysis($id)
    {
        return OctFacade::deleteAnalysis($id);
    }

    public function deleteMainAnalysis($id)
    {
        return OctFacade::deleteMainAnalysis($id);
    }
}
