<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\EyeScanService;
use Illuminate\Support\Facades\Facade;

class EyeScanFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return EyeScanService::class;
    }
}
