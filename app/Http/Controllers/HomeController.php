<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\App;
use App\Models\Description;
use App\Models\list_apps;
use App\Models\Plans;
use App\Models\Roles;
use App\Models\Tarif;

use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function getApps()
    {
        $apps = App::all();
        return Inertia::render('Home', [
            'apps' => $apps,
        ]);
    }
    public function getApp($appId)
    {
        try {
            $apps = App::all();
            $app = App::where('slug', $appId)->firstOrFail();

            $categorie = [$app['categories'],$app['subcategories'],$app['subcategories1']];

            $desc = Description::where('app_id', $app['app_id'])->first();
            $roles = Roles::where('desc_id',$desc['desc_id'])->pluck('name')->toArray();

            $description=['title'=>$desc['title'],'body'=>$desc['body']];

            $prices = Tarif::where('app_id', $app['app_id'])->get();

            $result_price = [];

            foreach ($prices as $price) {
                $plan = Plans::where('tarif_id', $price['tarif_id'])->pluck('name')->toArray();
                $value = [
                "name" => $price['name'],
                "price" => str_replace('/month', '', $price['price']),
                "plan" => $plan, 
            ];
            $result_price[] = $value;
        }
        $url = list_apps::where('id', $app['id'])->get('url');
        $allmedia=[];
        $medias=$app->getMedia('media');
        $app['video'] != null ?  $allmedia[]=$app['video']:'';
        foreach($medias as $media){
            $allmedia[]=substr($media['original_url'],22);
        }
        

       return Inertia::render('SingleApp', [
            'apps'=>$apps,
            'app' => $app,
            'categorie' => $categorie,
            'description' =>$description,
            'role' => $roles,
            'price' => $result_price,
            'url' => $url,
            'media'=>$allmedia
        ]);}
        
        catch (\Exception $e) {
            Log::error("Error in getApp: " . $e->getMessage());
            abort(404); 
        }
    }

    public function getAppsWithCategory($category){
        $appsCategories = App::where('categories',$category)->get();
        $apps=App::all();
        return Inertia::render('PageCategory', [
            'apps'=>$apps,
            'appsCategories' => $appsCategories,
        ]);
    }

    public function getAppsWithSubCategory($subcategory){
        $appsCategories = App::where('subcategories',$subcategory)->orWhere('subcategories1',$subcategory)->get();
        $apps=App::all();
        return Inertia::render('PageCategory', [
            'apps' => $apps,
            'appsCategories'=>$appsCategories
        ]);
    }

    public function getAppsDeveloper($developer){
        $appsDeveloper = App::where('developer',$developer)->get();
        $apps=App::all();
        return Inertia::render('PageCategory', [
            'apps' => $apps,
            'appsCategories'=>$appsDeveloper
        ]);
    }

    public function contact(){
        $apps=App::all();
        return Inertia::render('Contact', [
            'apps' => $apps,
        ]);
    }

    public function about(){
        $apps=App::all();
        return Inertia::render('About', [
            'apps' => $apps,
        ]);
    }

}
