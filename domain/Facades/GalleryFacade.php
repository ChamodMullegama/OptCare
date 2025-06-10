<?php

namespace domain\Facades;

use domain\Services\GalleryService;
use Illuminate\Support\Facades\Facade;

class GalleryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return GalleryService::class;
    }
}
