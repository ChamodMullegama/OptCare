<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use domain\Facades\AdminArea\CustomerFacade;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
       public function All()
    {
        try {
            $customers = CustomerFacade::all();
            return view('AdminArea.Pages.Customers.index', compact('customers'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
