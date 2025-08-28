<?php

namespace App\Http\Controllers\PublicArea;


use App\Http\Controllers\Controller;
use App\Models\PatientOctAnalysis;
use Barryvdh\DomPDF\Facade\Pdf;
use domain\Facades\PublicArea\PublicOCTFacade;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PublicOCTController extends Controller
{

    public function UploadOctPublic()
    {
        return PublicOCTFacade::showUploadForm();
    }

    public function analyzeOctPublic(Request $request)
    {
        return PublicOCTFacade::analyzeOct($request);
    }

    public function downloadAnalysisPublic(Request $request)
    {
        return PublicOCTFacade::downloadAnalysis($request);
    }

    public function requestDoctorAdvice($id)
    {
        return PublicOCTFacade::requestDoctorAdvice($id);
    }
}
