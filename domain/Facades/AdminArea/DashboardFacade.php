<?php

namespace domain\Facades\AdminArea;


use domain\Services\AdminArea\DashboardService;
use Illuminate\Support\Facades\Facade;

class DashboardFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return DashboardService::class;
    }
}
