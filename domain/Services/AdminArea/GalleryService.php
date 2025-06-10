<?php

namespace domain\Services\AdminArea;

use App\Models\Gallery;
use Illuminate\Support\Str;

class GalleryService
{
    protected $gallery;

    public function __construct()
    {
        $this->gallery = new Gallery();
    }

    public function all()
    {
        return $this->gallery->all();
    }

    public function store(array $data)
    {
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['galleryId'] = 'GL' . Str::random(6);
            $data['image'] = $data['image']->store('uploads/gallery', 'public');
        }
        return $this->gallery->create($data);
    }

    public function update(array $data, $id)
    {
        $gallery = $this->gallery->find($id);
        if (!$gallery) {
            throw new \Exception('Gallery not found.');
        }

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($gallery->image && file_exists(public_path('uploads/' . $gallery->image))) {
                unlink(public_path('uploads/' . $gallery->image));
            }
            $data['image'] = $data['image']->store('uploads/gallery', 'public');
        } else {
            $data['image'] = $gallery->image;
        }

        $gallery->update([
            'title' => $data['title'],
            'image' => $data['image'],
        ]);

        return $gallery;
    }

    public function delete($id)
    {
        $gallery = $this->gallery->findOrFail($id);
        if ($gallery->image && file_exists(public_path('uploads/' . $gallery->image))) {
            unlink(public_path('uploads/' . $gallery->image));
        }
        $gallery->delete();
        return true;
    }
}
