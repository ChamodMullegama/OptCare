<?php

namespace domain\Services\PublicArea;

use App\Models\ProductCategory;

class ProductCategoryService
{
    protected $category;

    public function __construct()
    {
        $this->category = new ProductCategory();
    }

    public function all()
    {
        return $this->category->all();
    }
}
