<?php

namespace domain\Facades\DoctorArea;

use domain\Services\DoctorArea\DashboardService;
use Illuminate\Support\Facades\Facade;

class DashboardFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return DashboardService::class;
    }
}
