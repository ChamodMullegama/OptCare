<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\PublicOCTService;
use Illuminate\Support\Facades\Facade;

class PublicOCTFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PublicOCTService::class;
    }
}
