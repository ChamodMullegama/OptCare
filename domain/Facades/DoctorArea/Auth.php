<?php

namespace domain\Facades\DoctorArea;

use Illuminate\Support\Facades\Facade;
use domain\Services\DoctorArea\AuthService;

class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AuthService::class;
    }
}
