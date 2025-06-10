<?php

namespace App\Http\Controllers\AdminArea;

use domain\Facades\AdminArea\BlogFacade;
use App\Http\Controllers\Controller;
use App\Models\BlogImage;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function All()
    {
        try {
            $blogs = BlogFacade::all();
            return view('AdminArea.Pages.Blog.index', compact('blogs'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Add(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title',
            'date' => 'required|date',
            'content' => 'required|string',
            'tags' => 'nullable|string',
            'special_thing' => 'nullable|string',
        ], [
            'title.unique' => 'The blog title must be unique. Please choose another title.',
        ]);

        try {
            $data = $request->all();
            BlogFacade::store($data);
            return back()->with('success', 'Blog added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title,' . $request->id,
            'date' => 'required|date',
            'content' => 'required|string',
            'tags' => 'nullable|string',
            'special_thing' => 'nullable|string',
        ], [
            'title.unique' => 'The blog title must be unique. Please choose another title.',
        ]);

        try {
            $data = $request->all();
            BlogFacade::update($data, $request->id);
            return redirect()->back()->with('success', 'Blog updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:blogs,id',
            ]);

            BlogFacade::delete($request->id);
            return back()->with('success', 'Blog deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

public function BlogImageAdd(Request $request)
    {
        $request->validate([
            'blogId' => 'required|exists:blogs,blogId',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }
            BlogFacade::blogImageAdd($data);
            return back()->with('success', 'Image added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewBlogImageAll($blogId)
    {
        try {
            $blog_images = BlogFacade::viewBlogImageAll($blogId);
            return view('AdminArea.Pages.Blog.viewBlogImage', compact('blog_images'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewBlogImageDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:blog_images,id',
            ]);

            BlogFacade::viewBlogImageDelete($request->id);
            return back()->with('success', 'Image deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function IsPrimary($id)
    {
        try {
            BlogFacade::isPrimary($id);
            $message = BlogImage::findOrFail($id)->isPrimary ? 'Image activated successfully!' : 'Image deactivated successfully!';
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
