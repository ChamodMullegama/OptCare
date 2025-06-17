<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\DoctorService;
use Illuminate\Support\Facades\Facade;

class DoctorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
          return DoctorService::class;
    }
}
