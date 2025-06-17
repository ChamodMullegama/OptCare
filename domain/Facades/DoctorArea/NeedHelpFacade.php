<?php

namespace domain\Facades\DoctorArea;

use domain\Services\DoctorArea\NeedHelpService;
use Illuminate\Support\Facades\Facade;

class NeedHelpFacade extends Facade
{
    protected static function getFacadeAccessor()
    {

     return NeedHelpService::class;

    }
}
