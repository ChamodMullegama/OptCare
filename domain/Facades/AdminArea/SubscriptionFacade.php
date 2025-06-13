<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\SubscriptionService;
use Illuminate\Support\Facades\Facade;

class SubscriptionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SubscriptionService::class;
    }
}
