<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CategoryService;

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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();
        $this->categoryService = $categoryService;
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

        try {
            $this->categoryService->storeCategoryData([
                'name' => $name,
                'description' => $description
            ]);
            $this->line('category saved successfully ');
        } catch (\Throwable $th) {
            $this->error('Something went wrong!');
        }
    }
}
