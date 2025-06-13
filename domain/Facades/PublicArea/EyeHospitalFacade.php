<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\EyeHospitalService;
use Illuminate\Support\Facades\Facade;

class EyeHospitalFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return EyeHospitalService::class;
    }
}
