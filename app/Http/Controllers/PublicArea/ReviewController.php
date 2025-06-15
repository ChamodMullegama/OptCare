<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use domain\Facades\PublicArea\ReviewFacade;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
     public function Add(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'message' => 'required|string',
            ]);

            $data = $request->all();
            ReviewFacade::store($data);

            return redirect()->back()->with('success', 'Review submitted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


    public function All()
    {
        try {
            $reviews = ReviewFacade::all();
            return view('AdminArea.Pages.Review.index', compact('reviews'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


    public function Display()
    {
        try {
            $reviews = ReviewFacade::all();
            return view('PublicArea.Pages.AboutUs.index', compact('reviews'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:reviews,id',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'message' => 'required|string',
            ]);

            $data = $request->all();
            ReviewFacade::update($data, $request->id);

            return redirect()->back()->with('success', 'Review updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:reviews,id',
            ]);

            ReviewFacade::delete($request->id);

            return redirect()->back()->with('success', 'Review deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
