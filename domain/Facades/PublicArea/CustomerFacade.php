<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\CustomerService;
use Illuminate\Support\Facades\Facade;

class CustomerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
       return CustomerService::class;
    }
}
