<?php

namespace domain\Facades\DoctorArea;

use App\Models\OctAnalysis;
use Illuminate\Support\Facades\Facade;

class OctFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OctAnalysis::class;
    }
}
