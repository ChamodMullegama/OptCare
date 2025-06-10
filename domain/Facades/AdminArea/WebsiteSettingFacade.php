<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\WebsiteSettingService;
use Illuminate\Support\Facades\Facade;

class WebsiteSettingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return WebsiteSettingService::class;
    }
}
