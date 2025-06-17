<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\DoctorReview;
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

   public function DoctorReviewAdd(Request $request)
{
    try {
        $request->validate([
            'doctorId' => 'required|string|exists:doctors,doctorId',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string',
        ]);

        $data = $request->only(['doctorId', 'name', 'email', 'message']);
        ReviewFacade::DoctorReviewAdd($data);

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


    // public function DoctorReviewDisplay()
    // {
    //     try {
    //         $doctorreviews = ReviewFacade::DoctorReviewAll();
    //         return view('PublicArea.Pages.Doctor.details', compact('doctor_reviews'));
    //     } catch (\Exception $e) {
    //         return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    //     }
    // }

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


   public function DoctorReviewAll()
{
    try {
        $doctorId = session('doctor.doctorId'); // Get doctorId directly from session
        $doctor_reviews = DoctorReview::where('doctorId', $doctorId)->get();

        return view('DoctorArea.Pages.Review.index', compact('doctor_reviews'));
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to load reviews. Please try again.');
    }
}

    public function DoctorReviewDelete(Request $request)
{
    try {
        $request->validate([
            'id' => 'required|integer|exists:doctor_reviews,id',
        ]);

        ReviewFacade::doctorReviewDelete($request->id);

        return redirect()->back()->with('success', 'Review deleted successfully!');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    }
}
}
