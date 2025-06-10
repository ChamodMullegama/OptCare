<?php

namespace domain\Services;

use App\Models\ProductCategory;

class ProductCategoryService
{
    protected $productCategory;

    public function __construct()
    {
        $this->productCategory = new ProductCategory();
    }

    public function all()
    {
        return $this->productCategory->all();
    }

    public function store(array $data)
    {
        return $this->productCategory->create($data);
    }

    public function update(array $data, $id)
    {
        $category = $this->productCategory->findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = $this->productCategory->findOrFail($id);
        $category->delete();
        return true;
    }
}
