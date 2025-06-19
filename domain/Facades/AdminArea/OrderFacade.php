<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\OrderService;
use Illuminate\Support\Facades\Facade;

class OrderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
          return OrderService::class;
    }
}
