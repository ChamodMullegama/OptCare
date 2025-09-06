<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use domain\Facades\AdminArea\ServiceFacade;
use domain\Facades\PublicArea\BlogFacade;
use domain\Facades\PublicArea\DoctorFacade;
use domain\Facades\PublicArea\GalleryFacade;
use domain\Facades\PublicArea\ReviewFacade;
use domain\Facades\PublicArea\TeamFacade;
use Illuminate\Http\Request;

class HomeController extends Controller
{

        public function index()
    {
        try {
            $galleries = GalleryFacade::all();
            $blogs = BlogFacade::getLatestBlogs(3);
            $doctorS = DoctorFacade::all();
            $services = ServiceFacade::allForPublic()->take(3);
            return view('PublicArea.Pages.Home.index', compact('galleries', 'blogs','doctorS','services'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function AboutUs()
    {
        try {
         $teams = TeamFacade::all();
         $reviews = ReviewFacade::all();
        return view('PublicArea.Pages.aboutUs.index', compact('teams','reviews'));


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
