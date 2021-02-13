<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Services\CategoryProductService;


class ProductService
{

    /**
     * @var $productRepository
     */
    protected $productRepository;
    protected $categoryProductService;

    /**
     * ProductService Constructor
     *
     * @param ProductRepository  $productRepository
     * @param CategoryProductService  $categoryProductService
     */

    public function __construct(ProductRepository $productRepository, CategoryProductService $categoryProductService)
    {
        $this->productRepository = $productRepository;
        $this->categoryProductService = $categoryProductService;
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

        $product = $this->productRepository->save($data);
        $this->categoryProductService->storeCategoryProductData(
            [
                'category_id' => $productData->categoryID,
                'product_id' => $product->id
            ]
        );
        return  $product;
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


        $product = $this->productRepository->save($data);

        $this->categoryProductService->storeCategoryProductData(
            [
                'category_id' => $productData['categoryID'],
                'product_id' => $product->id
            ]
        );
        return  $product;
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
