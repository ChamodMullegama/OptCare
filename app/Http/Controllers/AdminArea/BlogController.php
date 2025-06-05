<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogImage;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function All()
    {
        try {
            $blogs = Blog::all();
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
            $data['blogId'] = 'BL' . Str::random(6);
            Blog::create($data);
            return back()->with('success', 'Blog added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Update(Request $request)
    {
        $blog = Blog::find($request->id);

        $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title,' . $blog->id,
            'date' => 'required|date',
            'content' => 'required|string',
            'tags' => 'nullable|string',
            'special_thing' => 'nullable|string',
        ], [
            'title.unique' => 'The blog title must be unique. Please choose another title.',
        ]);

        try {
            $data = $request->all();
            $blog->update([
                'title' => $data['title'],
                'date' => $data['date'],
                'content' => $data['content'],
                'tags' => $data['tags'],
                'special_thing' => $data['special_thing'],
            ]);
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

            $blog = Blog::findOrFail($request->id);
            $blog->delete();
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
            $data['blogImageId'] = 'BI' . Str::random(6);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('uploads/blogs', 'public');
                $data['image'] = $path;
            }
            BlogImage::create($data);
            return back()->with('success', 'Image added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function ViewBlogImageAll($blogId)
    {
        try {
            $blog_images = BlogImage::where('blogId', $blogId)->get();
            return view('AdminArea.Pages.Blog.viewBlogImage', compact('blog_images'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    // public function ViewBlogImageDelete(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'id' => 'required|integer|exists:blog_images,id',
    //         ]);

    //         $blog_image = BlogImage::findOrFail($request->id);
    //         if ($blog_image->image && Storage::disk('public')->exists($blog_image->image)) {
    //             Storage::disk('public')->delete($blog_image->image);
    //         }
    //         $blog_image->delete();
    //         return back()->with('success', 'Image deleted successfully!');
    //     } catch (\Exception $e) {
    //         return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    //     }
    // }

    public function ViewBlogImageDelete(Request $request)
{
    try {
        // Validate the request
        $request->validate([
             'id' => 'required|integer|exists:blog_images,id',
        ]);

        // Find the student by ID
        $blog_image = BlogImage::findOrFail($request->id);

        // Delete the associated image if it exists
        if ($blog_image->image && file_exists(public_path('uploads/' . $blog_image->image))) {
            unlink(public_path('uploads/' . $blog_image->image));
        }

        // Delete the student record
        $blog_image->delete();

        // Return success response
        return back()->with('success', 'Image deleted successfully!');
    } catch (\Exception $e) {
        // Return error response
        return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    }
}

    public function IsPrimary($id)
    {
        try {
            $item = BlogImage::findOrFail($id);
            if ($item->isPrimary == 0) {
                BlogImage::where('id', '!=', $id)->update(['isPrimary' => 0]);
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
