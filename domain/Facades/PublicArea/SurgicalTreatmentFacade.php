<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\SurgicalTreatmentService;
use Illuminate\Support\Facades\Facade;

class SurgicalTreatmentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SurgicalTreatmentService::class;
    }
}
