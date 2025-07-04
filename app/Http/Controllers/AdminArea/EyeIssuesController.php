<?php

namespace App\Http\Controllers\AdminArea;

use domain\Facades\AdminArea\EyeIssueFacade;
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
            $eyeIssues = EyeIssueFacade::getAll();
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
            'name.unique' => 'The eye disease name must be unique. Please choose another name.',
        ]);

        try {
            $data = $request->all();
            EyeIssueFacade::store($data);
            return back()->with('success', 'Eye disease added successfully!');
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
            'name.unique' => 'The eye disease name must be unique. Please choose another name.',
        ]);

        try {
            $data = $request->all();
            EyeIssueFacade::update($request->id, $data);
            return redirect()->back()->with('success', 'Eye disease updated successfully!');
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

            EyeIssueFacade::delete($request->id);
            return back()->with('success', 'Eye disease deleted successfully!');
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
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('uploads/eye_issues', 'public');
                $data['image'] = $path;
            }
            EyeIssueFacade::addImage($request);
            return back()->with('success', 'Image added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewEyeIssueImageAll($eyeIssueId)
    {
        try {
            $eye_issue_images = EyeIssueFacade::getImages($eyeIssueId);
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

            EyeIssueFacade::deleteImage($request->id);
            return back()->with('success', 'Image deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function IsPrimary($id)
    {
        try {
            $message = EyeIssueFacade::setPrimary($id);
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
