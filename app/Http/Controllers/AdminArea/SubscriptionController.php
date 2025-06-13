<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use domain\Facades\AdminArea\SubscriptionFacade;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
     public function All()
    {
        try {
            $subscriptions = SubscriptionFacade::all();
            return view('AdminArea.Pages.Subscriptions.index', compact('subscriptions'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:subscriptions,id',
            ]);

            SubscriptionFacade::delete($request->id);
            return back()->with('success', 'Subscription deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function sendBroadcast(Request $request)
    {
        try {
            $request->validate([
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            SubscriptionFacade::sendBroadcast($request->subject, $request->message);
            return back()->with('success', 'Broadcast email sent successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }



}
