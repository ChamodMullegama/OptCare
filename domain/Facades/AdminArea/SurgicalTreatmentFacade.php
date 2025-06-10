<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\SurgicalTreatmentService;
use Illuminate\Support\Facades\Facade;

class SurgicalTreatmentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
            return SurgicalTreatmentService::class;
    }
}
