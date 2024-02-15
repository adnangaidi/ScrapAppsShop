<?php

namespace App\Http\Controllers;

use App\Models\CategoryParent;
use App\Models\FerstSubCatigory;
use App\Models\list_apps;
use App\Models\SecondSubCatigory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ListAppsController extends Controller
{
    //function compile url apps in one table
    public function CompileApps(){
        set_time_limit(1600);

        $subcategories = FerstSubCatigory::pluck('fsc_id')->toArray();
        $secondSubCategories = SecondSubCatigory::pluck('fsc_id')->toArray();
        foreach ($subcategories as $sub) {
            if (in_array($sub, $secondSubCategories)) {
                $seconds = SecondSubCatigory::where('fsc_id', $sub)->get();
                foreach($seconds as $second){
                    $namecategoryparent=CategoryParent::where('cp_id', $second['cp_id'])->value('name');
                    $namefirstsub=FerstSubCatigory::where('fsc_id', $second['fsc_id'])->value('name');
                    $namesecondsub=SecondSubCatigory::where('ssc_id', $second['ssc_id'])->value('name');
                    $url=$second['url'];
                    $res=shell_exec('C:/PYTHON/python.exe "d:/stage/Nouveau dossier/appscrap/app/Script_python/categories/main.py" "' . $url . '"');
                    $results = json_decode($res, true);
                    if ($results !== null) {
                        for($i=0;$i<count($results);$i++){
                              $url_apps=new list_apps();
                              $url_apps->url=$results[$i];
                              $url_apps->categories=$namecategoryparent;
                              $url_apps->subcategories=$namefirstsub;
                              $url_apps->subcategories1=$namesecondsub;
                              $url_apps->status='not scraped';
                              $url_apps->save();
                              Log::info($url_apps);
                        }
                    }
                }
            } else {
                $category = FerstSubCatigory::where('fsc_id', $sub)->first();
                $namecategoryparent=CategoryParent::where('cp_id', $category->cp_id)->value('name');
                $namefirstsub=FerstSubCatigory::where('fsc_id', $category->fsc_id)->value('name');
                if ($category) {
                    $url = $category->url;
                    $res=shell_exec('C:/PYTHON/python.exe "d:/stage/Nouveau dossier/appscrap/app/Script_python/categories/main.py" "' . $url . '"');
                    $results = json_decode($res, true);
                    if ($results !== null) {
                        for($i=0;$i<count($results);$i++){
                              $url_apps=new list_apps();
                              $url_apps->url=$results[$i];
                              $url_apps->categories=$namecategoryparent;
                              $url_apps->subcategories=$namefirstsub;
                              $url_apps->status='not scraped';
                              $url_apps->save();
                              Log::info($url_apps);
                            }
                    }
                }
            }
        }
    }
    public function test(){
        $lists_apps=list_apps::where('status','not scraped')->where('categories','Finding products')->limit(10)->get();
        // $lists_apps1=list_apps::where('status','not scraped')->where('categories','Selling products')->limit(10)->get();
        // $lists_apps2=list_apps::where('status','not scraped')->where('categories','Orders and shipping')->limit(10)->get();
        // $lists_apps3=list_apps::where('status','not scraped')->where('categories','Store design')->limit(10)->get();
        // $lists_apps4=list_apps::where('status','not scraped')->where('categories','Marketing and conversion')->limit(10)->get();

        for($i=0;$i<count($lists_apps);$i++){
           $controller=app(ScrapController::class);
           $controller->getdata($lists_apps[$i]['url'],$lists_apps[$i]['categories'],$lists_apps[$i]['subcategories'],$lists_apps[$i]['subcategories1']);
           $res=list_apps::find($lists_apps[$i]['id']);
           $res->status= 'scraped';
           $res->save();
        }
        // for($i=0;$i<count($lists_apps1);$i++){
        //     $controller=app(ScrapController::class);
        //     $controller->getdata($lists_apps1[$i]['url'],$lists_apps1[$i]['categories'],$lists_apps1[$i]['subcategories'],$lists_apps1[$i]['subcategories1']);
        //     $res=list_apps::find($lists_apps1[$i]['id']);
        //     $res->status= 'scraped';
        //     $res->save();
        //  }
        //  for($i=0;$i<count($lists_apps2);$i++){
        //     $controller=app(ScrapController::class);
        //     $controller->getdata($lists_apps2[$i]['url'],$lists_apps2[$i]['categories'],$lists_apps2[$i]['subcategories'],$lists_apps2[$i]['subcategories1']);
        //     $res=list_apps::find($lists_apps2[$i]['id']);
        //     $res->status= 'scraped';
        //     $res->save();
        //  }
    //      for($i=0;$i<count($lists_apps);$i++){
    //         $controller=app(ScrapController::class);
    //         $controller->getdata($lists_apps3[$i]['url'],$lists_apps3[$i]['categories'],$lists_apps3[$i]['subcategories'],$lists_apps3[$i]['subcategories1']);
    //         $res=list_apps::find($lists_apps3[$i]['id']);
    //         $res->status= 'scraped';
    //         $res->save();
    //      }
    //      for($i=0;$i<count($lists_apps);$i++){
    //         $controller=app(ScrapController::class);
    //         $controller->getdata($lists_apps4[$i]['url'],$lists_apps4[$i]['categories'],$lists_apps4[$i]['subcategories'],$lists_apps4[$i]['subcategories1']);
    //         $res=list_apps::find($lists_apps4[$i]['id']);
    //         $res->status= 'scraped';
    //         $res->save();
    //      }
    }



}



