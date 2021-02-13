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
}
