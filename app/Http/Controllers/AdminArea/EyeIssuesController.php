<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\EyeIssue;
use App\Models\EyeIssueImage;
use Illuminate\Http\Request;


use Illuminate\Support\Str;

class EyeIssuesController extends Controller
{
     public function All()
    {
        try {
            $eyeIssues = EyeIssue::all();
            return view('AdminArea.Pages.EductionContent.eyeDisease', compact('eyeIssues'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:eye_issues,name',
            'description' => 'required|string',
            'symptoms' => 'required|string',
            'causes' => 'required|string',
            'treatments' => 'required|string',
        ], [
            'name.unique' => 'The eye issue name must be unique. Please choose another name.',
        ]);

        try {
            $data = $request->all();
            $data['eyeIssueId'] = 'EI' . Str::random(6);
            EyeIssue::create($data);
            return back()->with('success', 'Eye issue added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $eyeIssue = EyeIssue::find($request->id);

        $request->validate([
            'name' => 'required|string|max:255|unique:eye_issues,name,' . $eyeIssue->id,
            'description' => 'required|string',
            'symptoms' => 'required|string',
            'causes' => 'required|string',
            'treatments' => 'required|string',
        ], [
            'name.unique' => 'The eye issue name must be unique. Please choose another name.',
        ]);

        try {
            $data = $request->all();
            $eyeIssue->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'symptoms' => $data['symptoms'],
                'causes' => $data['causes'],
                'treatments' => $data['treatments'],
            ]);
            return redirect()->back()->with('success', 'Eye issue updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:eye_issues,id',
            ]);

            $eyeIssue = EyeIssue::findOrFail($request->id);
            $eyeIssue->delete();
            return back()->with('success', 'Eye issue deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function EyeIssueImageAdd(Request $request)
    {
        $request->validate([
            'eyeIssueId' => 'required|exists:eye_issues,eyeIssueId',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->all();
            $data['eyeIssueImageId'] = 'EII' . Str::random(6);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('uploads/eye_issues', 'public');
                $data['image'] = $path;
            }
            EyeIssueImage::create($data);
            return back()->with('success', 'Image added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewEyeIssueImageAll($eyeIssueId)
    {
        try {
            $eye_issue_images = EyeIssueImage::where('eyeIssueId', $eyeIssueId)->get();
            return view('AdminArea.Pages.EductionContent.viewEyeDiseaseImage', compact('eye_issue_images'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewEyeIssueImageDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:eye_issue_images,id',
            ]);

            $eye_issue_image = EyeIssueImage::findOrFail($request->id);
                 if ($eye_issue_image->image && file_exists(public_path('uploads/' . $eye_issue_image->image))) {
            unlink(public_path('uploads/' . $eye_issue_image->image));
        }
            $eye_issue_image->delete();
            return back()->with('success', 'Image deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function IsPrimary($id)
    {
        try {
            $item = EyeIssueImage::findOrFail($id);
            if ($item->isPrimary == 0) {
                EyeIssueImage::where('id', '!=', $id)->update(['isPrimary' => 0]);
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
