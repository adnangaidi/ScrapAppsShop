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
        $lists_apps=list_apps::where('status','not scraped')->where('categories','Finding products')->limit(10)->get();
        $lists_apps1=list_apps::where('status','not scraped')->where('categories','Selling products')->limit(10)->get();
        $lists_apps2=list_apps::where('status','not scraped')->where('categories','Orders and shipping')->limit(10)->get();
        $lists_apps3=list_apps::where('status','not scraped')->where('categories','Store design')->limit(10)->get();
        $lists_apps4=list_apps::where('status','not scraped')->where('categories','Store management')->limit(10)->get();
        $lists_apps5=list_apps::where('status','not scraped')->where('categories','Marketing and conversion')->limit(10)->get();


        for($i=0;$i<count($lists_apps);$i++){
           $controller=app(ScrapController::class);
           $controller->getdata($lists_apps[$i]['url'],$lists_apps[$i]['categories'],$lists_apps[$i]['subcategories'],$lists_apps[$i]['subcategories1'],$lists_apps[$i]['id']);
           $res=list_apps::find($lists_apps[$i]['id']);
           $res->status= 'scraped';
           $res->save();
        }
        for($i=0;$i<count($lists_apps1);$i++){
            $controller=app(ScrapController::class);
            $controller->getdata($lists_apps1[$i]['url'],$lists_apps1[$i]['categories'],$lists_apps1[$i]['subcategories'],$lists_apps1[$i]['subcategories1'],$lists_apps1[$i]['id']);
            $res=list_apps::find($lists_apps1[$i]['id']);
            $res->status= 'scraped';
            $res->save();
         }
         for($i=0;$i<count($lists_apps2);$i++){
            $controller=app(ScrapController::class);
            $controller->getdata($lists_apps2[$i]['url'],$lists_apps2[$i]['categories'],$lists_apps2[$i]['subcategories'],$lists_apps2[$i]['subcategories1'],$lists_apps2[$i]['id']);
            $res=list_apps::find($lists_apps2[$i]['id']);
            $res->status= 'scraped';
            $res->save();
         }
         for($i=0;$i<count($lists_apps3);$i++){
            $controller=app(ScrapController::class);
            $controller->getdata($lists_apps3[$i]['url'],$lists_apps3[$i]['categories'],$lists_apps3[$i]['subcategories'],$lists_apps3[$i]['subcategories1'],$lists_apps3[$i]['id']);
            $res=list_apps::find($lists_apps3[$i]['id']);
            $res->status= 'scraped';
            $res->save();
         }
         for($i=0;$i<count($lists_apps4);$i++){
            $controller=app(ScrapController::class);
            $controller->getdata($lists_apps4[$i]['url'],$lists_apps4[$i]['categories'],$lists_apps4[$i]['subcategories'],$lists_apps4[$i]['subcategories1'],$lists_apps4[$i]['id']);
            $res=list_apps::find($lists_apps4[$i]['id']);
            $res->status= 'scraped';
            $res->save();
         }
        for($i=0;$i<count($lists_apps5);$i++){
            $controller=app(ScrapController::class);
            $controller->getdata($lists_apps5[$i]['url'],$lists_apps5[$i]['categories'],$lists_apps5[$i]['subcategories'],$lists_apps5[$i]['subcategories1'],$lists_apps5[$i]['id']);
            $res=list_apps::find($lists_apps5[$i]['id']);
            $res->status= 'scraped';
            $res->save();
         }
    }
   
}
