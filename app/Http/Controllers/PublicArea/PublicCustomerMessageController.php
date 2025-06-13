<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use domain\Facades\PublicArea\CustomerMessageFacade;
use Illuminate\Http\Request;

class PublicCustomerMessageController extends Controller
{
       public function Add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            CustomerMessageFacade::store($request->all());
            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
