<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use App\Models\TreatmentImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TreatmentsController extends Controller
{
    public function All()
    {
        try {
            $treatments = Treatment::all();
            return view('AdminArea.Pages.EductionContent.treatments', compact('treatments'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $request->validate([
            'treatment_name' => 'required|string|max:255|unique:treatments,treatment_name',
            'description' => 'required|string',
            'related_eye_diseases' => 'required|string',
            'benefits' => 'required|string',
        ], [
            'treatment_name.unique' => 'The treatment name must be unique. Please choose another name.',
        ]);

        try {
            $data = $request->all();
            $data['treatmentId'] = 'TR' . Str::random(6);
            Treatment::create($data);
            return back()->with('success', 'Treatment added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $treatment = Treatment::find($request->id);

        $request->validate([
            'treatment_name' => 'required|string|max:255|unique:treatments,treatment_name,' . $treatment->id,
            'description' => 'required|string',
            'related_eye_diseases' => 'required|string',
            'benefits' => 'required|string',
        ], [
            'treatment_name.unique' => 'The treatment name must be unique. Please choose another name.',
        ]);

        try {
            $data = $request->all();
            $treatment->update([
                'treatment_name' => $data['treatment_name'],
                'description' => $data['description'],
                'related_eye_diseases' => $data['related_eye_diseases'],
                'benefits' => $data['benefits'],
            ]);
            return redirect()->back()->with('success', 'Treatment updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:treatments,id',
            ]);

            $treatment = Treatment::findOrFail($request->id);
            $treatment->delete();
            return back()->with('success', 'Treatment deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function TreatmentImageAdd(Request $request)
    {
        $request->validate([
            'treatmentId' => 'required|exists:treatments,treatmentId',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->all();
            $data['treatmentImageId'] = 'TRI' . Str::random(6);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('uploads/treatments', 'public');
                $data['image'] = $path;
            }
            TreatmentImage::create($data);
            return back()->with('success', 'Image added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewTreatmentImageAll($treatmentId)
    {
        try {
            $treatment_images = TreatmentImage::where('treatmentId', $treatmentId)->get();
            return view('AdminArea.Pages.EductionContent.viewTreatmentImage', compact('treatment_images'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewTreatmentImageDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:treatment_images,id',
            ]);

            $treatment_image = TreatmentImage::findOrFail($request->id);
               if ($treatment_image->image && file_exists(public_path('uploads/' . $treatment_image->image))) {
            unlink(public_path('uploads/' . $treatment_image->image));
        }
            $treatment_image->delete();
            return back()->with('success', 'Image deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function IsPrimary($id)
    {
        try {
            $item = TreatmentImage::findOrFail($id);
            if ($item->isPrimary == 0) {
                TreatmentImage::where('id', '!=', $id)->update(['isPrimary' => 0]);
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
