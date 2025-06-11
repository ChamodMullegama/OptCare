<?php

namespace domain\Services\AdminArea;

use App\Models\Blog;
use App\Models\BlogImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogService
{
    protected $blog;
    protected $blogImage;

    public function __construct()
    {
        $this->blog = new Blog();
        $this->blogImage = new BlogImage();
    }

    public function all()
    {
        return $this->blog->all();
    }

    public function store(array $data)
    {
        $data['blogId'] = 'BL' . Str::random(6);
        return $this->blog->create($data);
    }

    public function update(array $data, $id)
    {
        $blog = $this->blog->findOrFail($id);
        $blog->update([
            'title' => $data['title'],
            'date' => $data['date'],
            'content' => $data['content'],
            'tags' => $data['tags'],
            'special_thing' => $data['special_thing'],
        ]);
        return $blog;
    }

    public function delete($id)
    {
        $blog = $this->blog->findOrFail($id);
        $blog->delete();
        return true;
    }

    public function blogImageAdd(array $data)
    {
        // Validate that blogId is present
        if (!isset($data['blogId']) || empty($data['blogId'])) {
            throw new \Exception('blogId is required for blog image creation.');
        }

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['blogImageId'] = 'BI' . Str::random(6);
            $data['image'] = $data['image']->store('uploads/blogs', 'public');
        } else {
            throw new \Exception('Image file is required or invalid.');
        }

        // Ensure blogId is included in the data for creation
        return $this->blogImage->create($data);
    }

    public function viewBlogImageAll($blogId)
    {
        return $this->blogImage->where('blogId', $blogId)->get();
    }

    public function viewBlogImageDelete($id)
    {
        $blogImage = $this->blogImage->findOrFail($id);
        if ($blogImage->image && file_exists(public_path('uploads/' . $blogImage->image))) {
            unlink(public_path('uploads/' . $blogImage->image));
        }
        $blogImage->delete();
        return true;
    }

    public function isPrimary($id)
    {
        $item = $this->blogImage->findOrFail($id);
        if ($item->isPrimary == 0) {
            $this->blogImage->where('id', '!=', $id)->update(['isPrimary' => 0]);
            $item->isPrimary = 1;
        } else {
            $item->isPrimary = 0;
        }
        $item->save();
        return $item;
    }

     public function allForPublic()
    {
        return Blog::with(['images' => function($query) {
            $query->where('isPrimary', 1)->orWhere('isPrimary', 0);
        }])->orderBy('date', 'desc')->get();
    }

    /**
     * Get a single blog with all images (for public details page)
     */
    public function findForPublic($blogId)
    {
        return Blog::with('images')->where('blogId', $blogId)->firstOrFail();
    }
}
