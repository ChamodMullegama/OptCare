<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
       public function All()
    {
        try {
            // Fetch all gallery data
            // $galleries = Gallery::all();

            return view('PublicArea.Pages.shop.checkout');
        } catch (\Exception $e) {
            // Handle any errors that occur
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }

    }

}
