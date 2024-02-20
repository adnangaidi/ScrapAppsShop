<?php

namespace App\Console\Commands;

use App\Http\Controllers\ScrapCategoryController;
use Illuminate\Console\Command;

class GetCategories extends Command
{
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

        $controller = app(ScrapCategoryController::class);
        $category = $controller->CategoryParent();
        if ($category != false) {
            $subcategory = $controller->FirstSubCategory();
            if ($subcategory != false) {
                $controller->SecondSubCategory();
            }
        }
        return response()->json(['the categories is save with successuful', 200]);
    }
}
