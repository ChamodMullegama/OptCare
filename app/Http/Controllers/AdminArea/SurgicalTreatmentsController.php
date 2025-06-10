<?php

namespace App\Http\Controllers\AdminArea;

use domain\Facades\SurgicalTreatmentFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SurgicalTreatmentsController extends Controller
{
    public function All()
    {
        try {
            $treatments = SurgicalTreatmentFacade::all();
            return view('AdminArea.Pages.Treatments.surgicalTreatment', compact('treatments'));
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

            SurgicalTreatmentFacade::store($validated);
            return back()->with('success', 'Surgical treatment added successfully!');
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

            SurgicalTreatmentFacade::update($validated, $request->id);
            return redirect()->back()->with('success', 'Surgical treatment updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:surgical_treatments,id',
            ]);

            SurgicalTreatmentFacade::delete($request->id);
            return back()->with('success', 'Surgical treatment deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
