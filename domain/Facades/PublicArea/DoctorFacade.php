<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\DoctorService;
use Illuminate\Support\Facades\Facade;

class DoctorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return DoctorService::class;
    }
}
