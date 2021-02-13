<?php

namespace App\Repositories;

use App\Models\category_product;

class CategoryProductRepository
{
    /**
     * @var categoryProduct
     */
    protected $categoryProduct;

    /**
     * CategoryRepository constructor
     *
     * @param category_product $categoryProduct
     */
    public function __construct(category_product $categoryProduct)
    {
        $this->categoryProduct = $categoryProduct;
    }

    /**
     * store  categoryProduct
     *
     * @param  $data
     * @return categoryProduct
     */

    public function save($data)
    {
        $categoryProduct = new $this->categoryProduct;

        $categoryProduct->category_id = $data['category_id'];
        $categoryProduct->product_id = $data['product_id'];


        $categoryProduct->save();

        return $categoryProduct->fresh();
    }
}
