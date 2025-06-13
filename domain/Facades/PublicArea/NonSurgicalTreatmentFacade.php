<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\NonSurgicalTreatmentService;
use Illuminate\Support\Facades\Facade;

class NonSurgicalTreatmentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return NonSurgicalTreatmentService::class;
    }
}
