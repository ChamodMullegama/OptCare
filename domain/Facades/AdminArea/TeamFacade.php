<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\TeamService;
use Illuminate\Support\Facades\Facade;

class TeamFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TeamService::class;
    }
}
