<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\ProductCategoryService;
use Illuminate\Support\Facades\Facade;

class ProductCategoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ProductCategoryService::class;
    }
}
