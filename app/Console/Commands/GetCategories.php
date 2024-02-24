<?php

namespace App\Console\Commands;


use App\Services\ScrapCategoriesService;
use Illuminate\Console\Command;

class GetCategories extends Command
{
    protected $categoryService;
    public function __construct(ScrapCategoriesService $category){
        parent::__construct();
       $this->categoryService=$category;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $category = $this->categoryService->CategoryParent();
        if ($category != false) {
            $subcategory = $this->categoryService->FirstSubCategory();
            if ($subcategory != false) {
                $this->categoryService->SecondSubCategory();
            }
        }
        $this->info('The categories have been saved successfully.');
    }
}
