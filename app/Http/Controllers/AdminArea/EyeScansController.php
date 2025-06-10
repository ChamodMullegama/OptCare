<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\EyeScan;
use App\Models\EyeScanImage;
use domain\Facades\EyeScanFacade;
use Illuminate\Http\Request;

class EyeScansController extends Controller
{
    public function All()
    {
        try {
            $eyeScans = EyeScanFacade::all();
            return view('AdminArea.Pages.EductionContent.scans', compact('eyeScans'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:eye_scans,name',
            'description' => 'required|string',
            'purpose' => 'nullable|string',
            'usage' => 'nullable|string',
        ], [
            'name.unique' => 'The eye scan name must be unique. Please choose another name.',
        ]);

        try {
            $data = $request->all();
            EyeScanFacade::store($data);
            return back()->with('success', 'Eye scan added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:eye_scans,name,' . $request->id,
            'description' => 'required|string',
            'purpose' => 'nullable|string',
            'usage' => 'nullable|string',
        ], [
            'name.unique' => 'The eye scan name must be unique. Please choose another name.',
        ]);

        try {
            $data = $request->all();
            EyeScanFacade::update($data, $request->id);
            return redirect()->back()->with('success', 'Eye scan updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:eye_scans,id',
            ]);

            EyeScanFacade::delete($request->id);
            return back()->with('success', 'Eye scan deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function EyeScanImageAdd(Request $request)
    {
        $request->validate([
            'eyeScanId' => 'required|exists:eye_scans,eyeScanId',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('uploads/eye_scans', 'public');
            }
            EyeScanFacade::eyeScanImageAdd($data);
            return back()->with('success', 'Image added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewEyeScanImageAll($eyeScanId)
    {
        try {
            $eye_scan_images = EyeScanFacade::viewEyeScanImageAll($eyeScanId);
            return view('AdminArea.Pages.EductionContent.viewEyeScanImage', compact('eye_scan_images'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewEyeScanImageDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:eye_scan_images,id',
            ]);

            EyeScanFacade::viewEyeScanImageDelete($request->id);
            return back()->with('success', 'Image deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function IsPrimary($id)
    {
        try {
            $message = EyeScanFacade::isPrimary($id);
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
