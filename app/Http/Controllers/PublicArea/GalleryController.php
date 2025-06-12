<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use domain\Facades\PublicArea\GalleryFacade;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

public function All()
    {
        try {
            $galleries = GalleryFacade::all();
            return view('PublicArea.Pages.Home.index', compact('galleries'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
