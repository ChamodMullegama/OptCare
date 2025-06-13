<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\ServiceService;
use Illuminate\Support\Facades\Facade;

class ServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ServiceService::class;
    }
}
