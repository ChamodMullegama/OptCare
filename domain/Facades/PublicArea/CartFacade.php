<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\CartService;
use Illuminate\Support\Facades\Facade;

class CartFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
    return CartService::class;
    }
}
