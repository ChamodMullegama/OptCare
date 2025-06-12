<?php

namespace domain\Services\PublicArea;

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


}
