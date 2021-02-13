<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\ProductService;
use App\Services\CategoryService;


class productsTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;


    /**
     * @var productService
     */
    protected $productService;

    /**
     * @var categoryService
     */
    protected $categoryService;



    /**
     * .
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
     * A basic feature test example.
     *
     * @return void
     */
    public function can_create_product_from_cli()
    {
        $this->artisan('add:product')
            ->expectsQuestion('What is the name of product?', 'product')
            ->expectsQuestion('give your product a description?', 'description')
            ->expectsQuestion('give your product a price?', '456')
            ->expectsQuestion('path of image?', config('app_path') . "/resources/images/avatar.jpeg")
            ->expectsChoice('What is your product category?', 'category1', $this->categoryService->getCategoriesNames())
            ->expectsOutput("Product saved successfully")
            ->assertExitCode(0);
    }

    public function can_create_product_from_request()
    {
        $attributes = [
            'name'=>$this->faker->name(),
            'description'=>$this->faker->paragraph(),
            'price'=> $this->faker->numberBetween(0,1000),
            'categoryID'=> 1
        ];
        $this->post('/api/product',$attributes);
        $this->assertDatabaseHas('products',[
            
        ])
    }
}
