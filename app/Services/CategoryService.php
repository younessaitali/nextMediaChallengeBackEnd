<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Arr;

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

    public function getCategoryIdByName($name)
    {
        return $this->categoryRepository->getCategoryIdByName($name)->id;
    }

    public function getCategoriesNames()
    {
        return Arr::flatten($this->categoryRepository->getCategoriesNames()->toArray());
    }
}
