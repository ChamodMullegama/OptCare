<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\EyeHospitalService;
use Illuminate\Support\Facades\Facade;

class EyeHospitalFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
       return EyeHospitalService::class;
    }
}
