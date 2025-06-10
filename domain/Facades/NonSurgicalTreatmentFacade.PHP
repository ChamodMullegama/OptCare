<?php

namespace domain\Facades;

use domain\Services\NonSurgicalTreatmentService;
use Illuminate\Support\Facades\Facade;

class NonSurgicalTreatmentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return NonSurgicalTreatmentService::class;
    }
}
