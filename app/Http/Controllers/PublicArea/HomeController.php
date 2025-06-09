<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

     public function index()
    {
        try {
            // Fetch all gallery data
            // $galleries = Gallery::all();

            return view('PublicArea.Pages.Home.index');
        } catch (\Exception $e) {
            // Handle any errors that occur
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }

    }

    public function AboutUs()
    {
        try {


            return view('PublicArea.Pages.aboutUs.index');
        } catch (\Exception $e) {
            // Handle any errors that occur
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }

    }

       public function ContactUs()
    {
        try {


            return view('PublicArea.Pages.contactUs.index');
        } catch (\Exception $e) {
            // Handle any errors that occur
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }

    }
}
