<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\EyeInvestigationsService;
use Illuminate\Support\Facades\Facade;

class EyeInvestigationsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return EyeInvestigationsService::class;
    }
}
