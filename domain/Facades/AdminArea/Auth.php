<?php

namespace domain\Facades\AdminArea;

use Illuminate\Support\Facades\Facade;
use domain\Services\AdminArea\AuthService;

class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AuthService::class;
    }
}
