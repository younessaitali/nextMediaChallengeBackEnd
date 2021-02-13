<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProductService;
use App\Services\CategoryService;


class createProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add product to the database';

    /**
     * @var productService
     */
    protected $productService;

    /**
     * @var categoryService
     */
    protected $categoryService;



    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        parent::__construct();
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $name = $this->ask('What is the name of product?');
        $description = $this->ask('give your product a description?');
        $price = $this->ask('give your product a price?');
        $path =  $this->ask('path of image?');

        $categoryName = $this->choice(
            'What is your product category?',
            $this->categoryService->getCategoriesNames()
        );

        $categoryID
            = $this->categoryService->getCategoryIdByName($categoryName);

        // try {
        $this->productService->storeProductDataCLI([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'path' => $path,
            'categoryID' => $categoryID
        ]);
        $this->line('Product saved successfully ');
        // } catch (\Throwable $th) {
        //     $this->error('Something went wrong!');
        // }
    }
}
