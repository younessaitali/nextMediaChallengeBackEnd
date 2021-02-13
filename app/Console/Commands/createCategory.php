<?php

namespace App\Console\Commands;

use App\Repositories\CategoryRepository;
use Illuminate\Console\Command;
use App\Services\CategoryService;
use Illuminate\Support\Arr;


class createCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add Category to the database';

    /**
     * @var categoryService
     */
    protected $categoryService;


    /**
     * @var categoryRepository
     */
    protected $categoryRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService, CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryService = $categoryService;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        $name = $this->ask('What is the name of category?');
        $description = $this->ask('give your category a description?');
        $parentCategory  = null;



        if ($this->confirm('is it subCategory?')) {
            $categoryName = $this->choice(
                'What is it?',
                Arr::flatten($this->categoryRepository->getCategoriesNames()->toArray())
            );
            $parentCategory
                = $this->categoryRepository->getCategoryIdByName($categoryName)->id;
        }


        try {
            $this->categoryService->storeCategoryData([
                'name' => $name,
                'description' => $description,
                "parent_id" => $parentCategory,
            ]);
            $this->line('category saved successfully ');
        } catch (\Throwable $th) {
            $this->error('Something went wrong!', $th);
        }
    }
}
