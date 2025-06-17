<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\BlogService;
use Illuminate\Support\Facades\Facade;

class BlogFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BlogService::class;
    }
}
