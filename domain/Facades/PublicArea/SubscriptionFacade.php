<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\SubscriptionService;
use Illuminate\Support\Facades\Facade;

class SubscriptionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SubscriptionService::class;
    }
}
