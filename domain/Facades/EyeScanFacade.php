<?php

namespace domain\Facades;

use domain\Services\EyeScanService;
use Illuminate\Support\Facades\Facade;

class EyeScanFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return EyeScanService::class;
    }
}
