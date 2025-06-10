<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\ProductService;
use Illuminate\Support\Facades\Facade;

class ProductFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ProductService::class;
    }
}
