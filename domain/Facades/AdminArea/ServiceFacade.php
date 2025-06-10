<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\ServiceService;
use Illuminate\Support\Facades\Facade;

class ServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ServiceService::class;
    }
}
