<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\BlogService;
use Illuminate\Support\Facades\Facade;

class BlogFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BlogService::class;
    }
}
