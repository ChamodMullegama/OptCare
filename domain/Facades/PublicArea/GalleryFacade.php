<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\GalleryService;
use Illuminate\Support\Facades\Facade;

class GalleryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return GalleryService::class;
    }
}
