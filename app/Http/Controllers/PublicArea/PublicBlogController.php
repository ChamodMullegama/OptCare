<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use domain\Facades\AdminArea\BlogFacade;
use Illuminate\Http\Request;

class PublicBlogController extends Controller
{
     public function All()
    {
        try {
            $blogs = BlogFacade::allForPublic(); // Make sure this method exists in BlogService
            return view('PublicArea.Pages.Blog.index', compact('blogs'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function Details($id)
{
    try {
        $blog = BlogFacade::findForPublic($id);
        $recentBlogs = Blog::with('images')
            ->where('blogId', '!=', $id)
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        return view('PublicArea.Pages.Blog.details', compact('blog', 'recentBlogs'));
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    }
}
}
