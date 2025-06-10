<?php

namespace domain\Facades;

use domain\Services\ProductCategoryService;
use Illuminate\Support\Facades\Facade;

class ProductCategoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ProductCategoryService::class;
    }
}
