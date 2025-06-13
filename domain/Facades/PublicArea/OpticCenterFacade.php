<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\OpticCenterService;
use Illuminate\Support\Facades\Facade;

class OpticCenterFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OpticCenterService::class;
    }
}
