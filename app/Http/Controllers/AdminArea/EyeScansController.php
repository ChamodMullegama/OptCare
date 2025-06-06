<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\EyeScan;
use App\Models\EyeScanImage;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EyeScansController extends Controller
{
     public function All()
    {
        try {
            $eyeScans = EyeScan::all();
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
            'purpose' => 'required|string',
            'usage' => 'required|string',
        ], [
            'name.unique' => 'The eye scan name must be unique. Please choose another name.',
        ]);

        try {
            $data = $request->all();
            $data['eyeScanId'] = 'ES' . Str::random(6);
            EyeScan::create($data);
            return back()->with('success', 'Eye scan added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $eyeScan = EyeScan::find($request->id);

        $request->validate([
            'name' => 'required|string|max:255|unique:eye_scans,name,' . $eyeScan->id,
            'description' => 'required|string',
            'purpose' => 'required|string',
            'usage' => 'required|string',
        ], [
            'name.unique' => 'The eye scan name must be unique. Please choose another name.',
        ]);

        try {
            $data = $request->all();
            $eyeScan->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'purpose' => $data['purpose'],
                'usage' => $data['usage'],
            ]);
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

            $eyeScan = EyeScan::findOrFail($request->id);
            $eyeScan->delete();
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
            $data['eyeScanImageId'] = 'ESI' . Str::random(6);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('uploads/eye_scans', 'public');
                $data['image'] = $path;
            }
            EyeScanImage::create($data);
            return back()->with('success', 'Image added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewEyeScanImageAll($eyeScanId)
    {
        try {
            $eye_scan_images = EyeScanImage::where('eyeScanId', $eyeScanId)->get();
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

            $eye_scan_image = EyeScanImage::findOrFail($request->id);

       if ($eye_scan_image->image && file_exists(public_path('uploads/' . $eye_scan_image->image))) {
            unlink(public_path('uploads/' . $eye_scan_image->image));
        }

            $eye_scan_image->delete();
            return back()->with('success', 'Image deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function IsPrimary($id)
    {
        try {
            $item = EyeScanImage::findOrFail($id);
            if ($item->isPrimary == 0) {
                EyeScanImage::where('id', '!=', $id)->update(['isPrimary' => 0]);
                $item->isPrimary = 1;
            } else {
                $item->isPrimary = 0;
            }
            $item->save();
            $message = $item->isPrimary ? 'Image activated successfully!' : 'Image deactivated successfully!';
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
