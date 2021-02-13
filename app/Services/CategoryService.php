<?php

namespace App\Services;

use App\Repositories\CategoryRepository;


class CategoryService
{

    /**
     * @var $categoryRepository
     */
    protected $categoryRepository;

    /**
     * CategoryService Constructor
     *
     * @param categoryRepository  $categoryRepository
     */

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function storeCategoryData($categoryData)
    {

        return  $this->categoryRepository->save($categoryData);
    }
}
