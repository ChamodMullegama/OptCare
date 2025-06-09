<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        public function AboutUs()
    {
        try {


            return view('PublicArea.Pages.aboutUs.index');
        } catch (\Exception $e) {
            // Handle any errors that occur
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }

    }
}
