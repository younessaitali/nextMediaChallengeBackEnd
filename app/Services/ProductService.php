<?php

namespace App\Services;

use App\Repositories\ProductRepository;


class ProductService
{

    /**
     * @var $productRepository
     */
    protected $productRepository;

    /**
     * ProductService Constructor
     *
     * @param ProductRepository  $productRepository
     */

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * store product data to data base form api call or web
     */

    public function storeProductData($productData)
    {
        $data = [
            'name' => $productData->name,
            'description' => $productData->description,
            'price' => $productData->price,
            'image' => $this->saveProductImage($productData->image)
        ];
        return  $this->productRepository->save($data);
    }

    /**
     * store product data from command line
     */

    public function storeProductDataCLI($productData)
    {

        $oldPath = $productData['path'];

        $newFileName = newGuid();

        $fileExtension = \File::extension($oldPath);

        $newFilePath = "./storage/app/products/$newFileName.$fileExtension";


        exec("cp $oldPath $newFilePath");

        $data = [
            'name' => $productData['name'],
            'description' => $productData['description'],
            'price' => $productData['price'],
            'image' => str_replace("./storage/app/", "", $newFilePath)
        ];
        return  $this->productRepository->save($data);
    }


    /**
     * this function handle storing files and also if we wanna resize or manipulate images before saving them
     *
     * @param  $imageData
     * @return string
     */
    public function saveProductImage($imageData)
    {

        return $imageData->store('products');
    }
}
