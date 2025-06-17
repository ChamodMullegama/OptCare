<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\CustomerService;
use Illuminate\Support\Facades\Facade;

class CustomerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CustomerService::class;
    }
}
