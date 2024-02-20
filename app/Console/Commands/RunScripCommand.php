<?php

namespace App\Console\Commands;

use App\Http\Controllers\ScrapController;
use App\Models\list_apps;
use Illuminate\Console\Command;


class RunScripCommand extends Command
{
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'script:run';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Run a script python';

   /**
    * Execute the console command.
    */
   public function handle()
   {
      set_time_limit(0);

      $categories = [
         'Finding products',
         'Selling products',
         'Orders and shipping',
         'Store design',
         'Store management',
         'Marketing and conversion',
      ];

      foreach ($categories as $category) {

         $lists_apps = list_apps::where('status', 'not scraped')
            ->where('categories', $category)
            ->limit(10)
            ->get();

         foreach ($lists_apps as $app) {
            $controller = app(ScrapController::class);
            $controller->getdata($app->url, $app->categories, $app->subcategories, $app->subcategories1, $app->id);

            $app->status = 'scraped';
            $app->save();
         }
      }
   }
}
