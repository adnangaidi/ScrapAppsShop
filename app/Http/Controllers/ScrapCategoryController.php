<?php

namespace App\Http\Controllers;

use App\Models\CategoryParent;
use App\Models\FerstSubCatigory;
use App\Models\SecondSubCatigory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ScrapCategoryController extends Controller
{
    //function extract category parent
    public function CategoryParent(){
        $url = "https://apps.shopify.com/";
        $res=shell_exec('C:/PYTHON/python.exe "d:/stage/Nouveau dossier/appscrap/app/Script_python/categories/script_category.py" "' . $url . '"');
        $results = json_decode($res, true);
        foreach($results as $result){
            if(isset($result['name']) && isset($result['href'])){
              $category=new CategoryParent();
              $category->name=$result['name'];
              $category->url=$result['href'];
              $category->save();
            }
        }
        log::info("results",$results);
    }
    public function FirstSubCategory(){
        $category=CategoryParent::all();
        foreach($category as $cat){
            $res=shell_exec('C:/PYTHON/python.exe "d:/stage/Nouveau dossier/appscrap/app/Script_python/categories/script_subcategory.py" "' . $cat['url'] . '"');
            $results = json_decode($res, true);
            foreach($results as $result){
                if(isset($result['name']) && isset($result['href'])){
                  $firstcategory=new FerstSubCatigory();
                  $firstcategory->name=$result['name'];
                  $firstcategory->url=$result['href'];
                  $firstcategory->cp_id=$cat->cp_id;
                  $firstcategory->save();
                  Log::info($firstcategory);
                }
               
            }
        }
        
    }
    public function SecondSubCategory(){
        set_time_limit(250);
        $category=FerstSubCatigory::all();
        foreach($category as $cat){
            $res=shell_exec('C:/PYTHON/python.exe "d:/stage/Nouveau dossier/appscrap/app/Script_python/categories/script_subcategory.py" "' . $cat['url'] . '"');
            $results = json_decode($res, true);
            Log::info($results);
            if ($results !== null) {
                foreach ($results as $result) {
                    if ($result !== null) {
                        if(isset($result['name']) && isset($result['href'])){
                                      $secondcategory=new SecondSubCatigory();
                                      $secondcategory->name=$result['name'];
                                      $secondcategory->url=$result['href'];
                                      $secondcategory->cp_id=$cat->cp_id;
                                      $secondcategory->fsc_id=$cat->fsc_id;
                                      $secondcategory->save();
                        }
                    }
                }
            }
        }
    }

}
