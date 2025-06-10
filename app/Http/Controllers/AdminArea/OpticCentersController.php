<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use domain\Facades\AdminArea\OpticCenterFacade;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;

class OpticCentersController extends Controller
{
 public function All()
    {
        try {
            $opticCenters = OpticCenterFacade::getAll();
            return view('AdminArea.Pages.OpticCenters.index', compact('opticCenters'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function AddPage()
    {
        try {
            return view('AdminArea.Pages.OpticCenters.addOpticCenter');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $request->validate([
            'hospital_name' => 'required|string|max:255|unique:optic_centers,hospital_name',
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
            OpticCenterFacade::store($data);
            return redirect()->route('optic.centers.all')->with('success', 'Optic Center added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function EditPage($id)
    {
        try {
            $opticCenter = OpticCenterFacade::getById($id);
            return view('AdminArea.Pages.OpticCenters.editOpticCenter', compact('opticCenter'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $opticCenter = OpticCenterFacade::getById($request->id);

        $request->validate([
            'hospital_name' => 'required|string|max:255|unique:optic_centers,hospital_name,' . $opticCenter->id,
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
            OpticCenterFacade::update($request->id, $data);
            return redirect()->route('optic.centers.all')->with('success', 'Optic Center updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:optic_centers,id',
            ]);

            OpticCenterFacade::delete($request->id);
            return back()->with('success', 'Optic Center deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function View($id)
    {
        try {
            $opticCenter = OpticCenterFacade::getById($id);
            return view('AdminArea.Pages.OpticCenters.viewOpticCenter', compact('opticCenter'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
