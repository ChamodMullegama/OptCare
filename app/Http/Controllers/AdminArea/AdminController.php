<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
       public function index()
    {
        // try {
            // Fetch all gallery data


            return view('AdminArea.Pages.Dashboard.index');
        // } catch (\Exception $e) {
        //     // Handle any errors that occur
        //     return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        // }

    }
}
