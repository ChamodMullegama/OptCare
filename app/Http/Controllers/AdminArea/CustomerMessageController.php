<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use domain\Facades\PublicArea\CustomerMessageFacade;
use Illuminate\Http\Request;

class CustomerMessageController extends Controller
{
      public function All()
    {
        try {
            $customerMessage = CustomerMessageFacade::all();
            return view('AdminArea.Pages.CustomerMessages.index', compact('customerMessage'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:customer_messages,id',
            ]);

            CustomerMessageFacade::delete($request->id);
            return back()->with('success', 'Message deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Reply(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:customer_messages,id',
                'reply_message' => 'required|string',
            ]);

            CustomerMessageFacade::reply($request->id, $request->reply_message);
            return back()->with('success', 'Reply sent successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
