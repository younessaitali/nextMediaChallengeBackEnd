<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProductService;


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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        parent::__construct();
        $this->productService = $productService;
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



        try {
            $this->productService->storeProductDataCLI([
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'path' => $path
            ]);
            $this->line('Product saved successfully ');
        } catch (\Throwable $th) {
            $this->error('Something went wrong!');
        }
    }
}
