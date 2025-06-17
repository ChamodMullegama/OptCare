<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use domain\Facades\AdminArea\NonSurgicalTreatmentFacade;
use Illuminate\Http\Request;

class NonSurgicalTreatmentsController extends Controller
{
    public function All()
    {
        try {
            $treatments = NonSurgicalTreatmentFacade::all();
            return view('AdminArea.Pages.Treatments.nonSurgicalTreatment', compact('treatments'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image');
            }

            NonSurgicalTreatmentFacade::store($validated);
            return back()->with('success', 'Non-surgical treatment added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image');
            }

            NonSurgicalTreatmentFacade::update($validated, $request->id);
            return redirect()->back()->with('success', 'Non-surgical treatment updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:non_surgical_treatments,id',
            ]);

            NonSurgicalTreatmentFacade::delete($request->id);
            return back()->with('success', 'Non-surgical treatment deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
