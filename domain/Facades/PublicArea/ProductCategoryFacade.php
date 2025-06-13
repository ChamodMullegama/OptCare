<?php

namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\ProductCategoryService;
use Illuminate\Support\Facades\Facade;

class ProductCategoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ProductCategoryService::class;
    }
}
