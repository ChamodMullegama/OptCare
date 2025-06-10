<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\NonSurgicalTreatmentService;
use Illuminate\Support\Facades\Facade;

class NonSurgicalTreatmentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return NonSurgicalTreatmentService::class;
    }
}
