<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Log;
use App\Services\InfoAppService;
use App\Services\PriceAppService;
use App\Services\ReviewAppService;
use App\Models\list_apps;
use App\Models\App;
use App\Traits\ScrapTrait;
use Illuminate\Console\Command;
use Exception;






class RunScripCommand extends Command
{
   private $infoAppService;
   private $priceAppService;
   private $reviewAppService;
   private $scrapTrait;

   public function __construct(
       InfoAppService $infoAppService,
       PriceAppService $priceAppService,
       ReviewAppService $reviewAppService,
       ScrapTrait $scrapTrait
   ) {
    parent::__construct();
       $this->infoAppService = $infoAppService;
       $this->priceAppService = $priceAppService;
       $this->reviewAppService = $reviewAppService;
       $this->scrapTrait=$scrapTrait;
   }
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
         $listApps = new list_apps();
         $lists_apps = $listApps->getNotScrapedAppsByCategory($category);

         foreach ($lists_apps as $app) {
            $this->getdata($app->url, $app->categories, $app->subcategories, $app->subcategories1, $app->id);
            $app->status = 'scraped';
            $app->save();
         }
      }
      $this->info('the apps scrap with successfully');
   }
   
   public function getdata($url, $categories, $subcategories, $subcategories1, $id){
      {
         set_time_limit(0);
 
         $info = $this->infoAppService->scrapAndSaveAppInfo($url, $categories, $subcategories, $subcategories1, $id);
         try {
             if ($info->getStatusCode() == 200) {
               $name=$this->infoAppService->name;
                 $app_id = App::where('name',$name )->value('app_id');
                 if ($app_id != null) {
                     $this->priceAppService->scrapeAndSavePrice($url, $app_id);
                     $url_clean=$this->scrapTrait->removeQueryParams($url);
                     $this->reviewAppService->scrapeAndSaveReviews($url_clean, $app_id);
                 } else {
                     return 'the id of app is null';
                 }
             }
             return 'data saved with successful';
         } catch (Exception $e) {
             Log::error("error the scrap this url $e");
         }
     }
   }
}
