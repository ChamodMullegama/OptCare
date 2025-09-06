<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use domain\Facades\AdminArea\GalleryFacade;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{

public function All()
    {
        try {
            $galleries = GalleryFacade::all();
            return view('AdminArea.Pages.Gallery.index', compact('galleries'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:galleries,title',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'title.unique' => 'The gallery title must be unique. Please choose another title.',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }
            GalleryFacade::store($data);
            return back()->with('success', 'Gallery added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:galleries,title,' . $request->id,
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'title.unique' => 'The gallery title must be unique. Please choose another name.',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }
            GalleryFacade::update($data, $request->id);
            return redirect()->back()->with('success', 'Gallery updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:galleries,id',
            ]);

            GalleryFacade::delete($request->id);
            return back()->with('success', 'Image deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


}



