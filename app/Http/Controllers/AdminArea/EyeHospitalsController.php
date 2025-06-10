<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use domain\Facades\AdminArea\EyeHospitalFacade;
use Illuminate\Http\Request;

class EyeHospitalsController extends Controller
{
    public function All()
    {
        try {
            $hospitals = EyeHospitalFacade::getAll();
            return view('AdminArea.Pages.Hospitals.index', compact('hospitals'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function AddPage()
    {
        try {
            return view('AdminArea.Pages.Hospitals.addHospital');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $request->validate([
            'hospital_name' => 'required|string|max:255|unique:eye_hospitals,hospital_name',
            'address' => 'required|string|max:500',
            'location' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'social_media_links' => 'nullable|array',
            'website_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'description' => 'nullable|string',
            'clinic_days' => 'nullable|array',
               'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }
            EyeHospitalFacade::store($data);
            return redirect()->route('eye.hospitals.all')->with('success', 'Hospital added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function EditPage($id)
    {
        try {
            $hospital = EyeHospitalFacade::getById($id);
            return view('AdminArea.Pages.Hospitals.editHospital', compact('hospital'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $hospital = EyeHospitalFacade::getById($request->id);

        $request->validate([
            'hospital_name' => 'required|string|max:255|unique:eye_hospitals,hospital_name,' . $hospital->id,
            'address' => 'required|string|max:500',
            'location' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'social_media_links' => 'nullable|array',
            'website_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'description' => 'nullable|string',
            'clinic_days' => 'nullable|array',
               'latitude' => '|numeric',
        'longitude' => '|numeric',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }
            EyeHospitalFacade::update($request->id, $data);
            return redirect()->route('eye.hospitals.all')->with('success', 'Hospital updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:eye_hospitals,id',
            ]);

            EyeHospitalFacade::delete($request->id);
            return back()->with('success', 'Hospital deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function View($id)
    {
        try {
            $hospital = EyeHospitalFacade::getById($id);
            return view('AdminArea.Pages.Hospitals.viewHospital', compact('hospital'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
