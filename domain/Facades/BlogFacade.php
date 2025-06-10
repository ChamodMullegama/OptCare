<?php

namespace domain\Facades;

use domain\Services\BlogService;
use Illuminate\Support\Facades\Facade;

class BlogFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BlogService::class;
    }
}
