<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\OpticCenterService;
use Illuminate\Support\Facades\Facade;

class OpticCenterFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OpticCenterService::class;
    }
}
