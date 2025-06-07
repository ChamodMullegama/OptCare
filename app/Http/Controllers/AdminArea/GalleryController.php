<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function All()
    {
        try {
            // Fetch all gallery data
            $galleries = Gallery::all();

            return view('AdminArea.Pages.Gallery.index', compact('galleries'));
        } catch (\Exception $e) {
            // Handle any errors that occur
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }

    }

     public function Add(Request $request)
    {
        // Validate input data
    $request->validate([
        'title' => 'required|string|max:255|unique:galleries,title', // Ensure the title is unique
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Optional image field (with max size)
    ], [
        'title.unique' => 'The gallery title must be unique. Please choose another title.',
    ]);

        try {
            $data = $request->all();

            // Generate a unique employeeId
            $data['galleryId'] = 'GL' . Str::random(6); // Random 6-character string with a prefix

            // Handle file upload using Laravel Storage
            if ($request->hasFile('image')) {
                // Get the uploaded file
                $file = $request->file('image');

                // Store the file in a specific directory and get its path
                $path = $file->store('uploads/gallery', 'public');

                // Save the file path to the $data array
                $data['image'] = $path;
            }

            // Save data
            Gallery::create($data);

            return back()->with('success', 'Gallery added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


public function update(Request $request)
{
    // Find the gallery item by ID
    $gallery = Gallery::find($request->id);

    // Validate inputs
    $request->validate([
        'title' => 'required|string|max:255|unique:galleries,title,' . $gallery->id, // Ensure the name is unique
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Optional image field
    ], [
        'title.unique' => 'The gallery title must be unique. Please choose another name.',

    ]);

    try {
        $data = $request->all();

        // Handle image upload using Laravel Storage
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($gallery->image) {
                Storage ::disk('public')->delete($gallery->image);
            }

            // Store the new image in 'uploads/images'
            $data['image'] = $request->file('image')->store('uploads/gallery', 'public');
        } else {
            // Retain the existing image path if no new image is uploaded
            $data['image'] = $gallery->image;
        }

        // Update employee details
        $gallery->update([
            'title' => $data['title'],
            'image' => $data['image'],
        ]);

        return redirect()->back()->with('success', 'Employee updated successfully!');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    }
}

public function Delete(Request $request)
{
    try {
        // Validate the request
        $request->validate([
            'id' => 'required|integer|exists:galleries,id',
        ]);

        // Find the student by ID
        $gallery = Gallery::findOrFail($request->id);

        // Delete the associated image if it exists
        if ($gallery->image && file_exists(public_path('uploads/' . $gallery->image))) {
            unlink(public_path('uploads/' . $gallery->image));
        }

        // Delete the student record
        $gallery->delete();

        // Return success response
        return back()->with('success', 'Image deleted successfully!');
    } catch (\Exception $e) {
        // Return error response
        return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    }
}

 public function home()
    {
        try {
            // Fetch all gallery data
            // $galleries = Gallery::all();

            return view('PublicArea.Pages.Home.index');
        } catch (\Exception $e) {
            // Handle any errors that occur
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }

    }

}



