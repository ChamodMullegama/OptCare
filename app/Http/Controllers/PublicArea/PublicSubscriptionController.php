<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use domain\Facades\PublicArea\SubscriptionFacade;
use Illuminate\Http\Request;

class PublicSubscriptionController extends Controller
{
      public function Add(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:subscriptions,email',
        ]);

        try {
            SubscriptionFacade::store($request->only(['email']));
            return redirect()->back()->with('success', 'Subscribed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()])->withInput();
        }
    }
}
