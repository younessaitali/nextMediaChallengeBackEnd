<?php

namespace App\Repositories;

use App\Models\product;

class ProductRepository
{
    /**
     * @var product
     */
    protected $product;

    /**
     * ProductRepository constructor
     *
     * @param product $product
     */
    public function __construct(product $product)
    {
        $this->product = $product;
    }



    /**
     * store  Product
     *
     * @param  $data
     * @return product
     */

    public function save($data)
    {
        $product = new $this->product;

        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->image = $data['image'];

        $product->save();

        return $product->fresh();
    }

    public function getProducts()
    {
        return $this->product;
    }

    public function getProductSortedBy($query, $sortedBy = "created_at", $orderBy = "desc")
    {
        return $query->orderBy($sortedBy, $orderBy);
    }



    public function getProductByCategory($query, $categoryId)
    {
        return $query->with('categories')
            ->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('category_id', '=', $categoryId);
            });
    }
}
