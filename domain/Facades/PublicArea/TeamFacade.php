<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\TeamService;
use Illuminate\Support\Facades\Facade;

class TeamFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TeamService::class;
    }
}
