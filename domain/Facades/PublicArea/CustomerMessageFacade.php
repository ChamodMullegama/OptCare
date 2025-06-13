<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\CustomerMessageService;
use Illuminate\Support\Facades\Facade;

class CustomerMessageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CustomerMessageService::class;
    }
}
