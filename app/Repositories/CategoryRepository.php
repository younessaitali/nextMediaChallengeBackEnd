<?php

namespace App\Repositories;

use App\Models\category;

class CategoryRepository
{
    /**
     * @var category
     */
    protected $category;

    /**
     * CategoryRepository constructor
     *
     * @param category $category
     */
    public function __construct(category $category)
    {
        $this->category = $category;
    }

    /**
     * store  category
     *
     * @param  $data
     * @return category
     */

    public function save($data)
    {
        $category = new $this->category;

        $category->name = $data['name'];
        $category->description = $data['description'];

        $category->save();

        return $category->fresh();
    }
}
