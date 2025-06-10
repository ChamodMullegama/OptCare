<?php

namespace domain\Facades;

use domain\Services\BlogService;
use domain\Services\DoctorService;
use Illuminate\Support\Facades\Facade;

class DoctorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
          return DoctorService::class;
    }
}
