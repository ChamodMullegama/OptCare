<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use domain\Facades\PublicArea\BlogFacade;
use domain\Facades\PublicArea\GalleryFacade;
use Illuminate\Http\Request;

class HomeController extends Controller
{

        public function index()
    {
        try {
            $galleries = GalleryFacade::all();
            $blogs = BlogFacade::getLatestBlogs(3);
            

            return view('PublicArea.Pages.Home.index', compact('galleries', 'blogs'));
        } catch (\Exception $e) {
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
