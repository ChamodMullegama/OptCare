<?php

namespace domain\Facades;

use domain\Services\SurgicalTreatmentService;
use Illuminate\Support\Facades\Facade;

class SurgicalTreatmentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
            return SurgicalTreatmentService::class;
    }
}
