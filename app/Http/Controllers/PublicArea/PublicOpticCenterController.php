<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\OpticCenter;
use Illuminate\Http\Request;

class PublicOpticCenterController extends Controller
{
        public function All()
    {
        $opticCenters = OpticCenter::all();
        return view('PublicArea.Pages.OpticCenters.index', compact('opticCenters'));
    }

    public function Search(Request $request)
    {
        $search = $request->input('search');

        $opticCenters = OpticCenter::where('hospital_name', 'like', '%' . $search . '%')
            ->orWhere('location', 'like', '%' . $search . '%')
            ->orWhere('address', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();

        return view('PublicArea.Pages.OpticCenters.index', compact('opticCenters', 'search'));
    }

    public function Details($hospitalId)
    {
        $opticCenter = OpticCenter::where('hospitalId', $hospitalId)->firstOrFail();
        $recentOpticCenters = OpticCenter::where('hospitalId', '!=', $hospitalId)->latest()->take(5)->get();
        return view('PublicArea.Pages.OpticCenters.Details', compact('opticCenter', 'recentOpticCenters'));
    }
}
