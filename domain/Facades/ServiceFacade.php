<?php

namespace domain\Facades;

use domain\Services\ServiceService;
use Illuminate\Support\Facades\Facade;

class ServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ServiceService::class;
    }
}
