<?php

namespace domain\Facades;

use domain\Services\WebsiteSettingService;
use Illuminate\Support\Facades\Facade;

class WebsiteSettingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return WebsiteSettingService::class;
    }
}
