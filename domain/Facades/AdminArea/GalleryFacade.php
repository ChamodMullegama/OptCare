<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\GalleryService;
use Illuminate\Support\Facades\Facade;

class GalleryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return GalleryService::class;
    }
}
