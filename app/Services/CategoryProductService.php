<?php

namespace App\Services;

use App\Repositories\CategoryProductRepository;

class CategoryProductService
{

    /**
     * @var $categoryProductRepository
     */
    protected $categoryProductRepository;

    /**
     * CategoryProductService Constructor
     *
     * @param CategoryProductRepository  $categoryProductRepository
     */

    public function __construct(CategoryProductRepository $categoryProductRepository)
    {
        $this->categoryProductRepository = $categoryProductRepository;
    }

    public function storeCategoryProductData($categoryData)
    {
        return  $this->categoryProductRepository->save($categoryData);
    }
}
