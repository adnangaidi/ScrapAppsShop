<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Models\App;
use App\Models\Description;
use App\Models\list_apps;
use App\Models\Plans;
use App\Models\Roles;
use App\Models\Tarif;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function getApps()
    {
        $apps = App::all();

        return Inertia::render('Home', [
            // 'canLogin' => Route::has('login'),
            // 'canRegister' => Route::has('register'),
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
            $role = Roles::where('desc_id',$desc['desc_id'])->get('name');
            $roles=[];
            foreach($role as $r){
                $roles[] = $r['name'];
            }
            $description=['title'=>$desc['title'],'body'=>$desc['body']];

            $prices = Tarif::where('app_id', $app['app_id'])->get();
           Log::info($prices);

            $result_price = [];
            $i=0;
            foreach ($prices as $price) {
                $plan = Plans::where('tarif_id', $price['tarif_id'])->get();
                $planData = $plan->toArray(); 
                $value = [
                "id" => $i+=1,
                //"tier-" . strtolower($price['name'])
                "name" => $price['name'],
                "href" => "#",
                "price" => str_replace('/month', '', $price['price']),
                "plan" => $planData, 
            ];
            Log::info( $value['id']);
            $result_price[] = $value;
        }
        $url = list_apps::where('id', $app['id'])->get('url');
        $allmedia=[];
        $media=$app->getMedia('media');
        $app['video'] != null ?  $allmedia[]=$app['video']:'';
        foreach($media as $med){
            $allmedia[]=substr($med['original_url'],22);
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
        Log::info($appsCategories);
        $apps=App::all();
        // Log::info("category",[$apps]);
        return Inertia::render('PageCategory', [
            'apps'=>$apps,
            'appsCategories' => $appsCategories,
        ]);
    }
    public function getAppsWithSubCategory($subcategory){
        $appsCategories = App::where('subcategories',$subcategory)->orWhere('subcategories1',$subcategory)->get();
        Log::info($appsCategories);
        $apps=App::all();
        return Inertia::render('PageCategory', [
            'apps' => $apps,
            'appsCategories'=>$appsCategories
        ]);
    }
    public function getAppsDeveloper($developer){
        $appsDeveloper = App::where('developer',$developer)->get();
        Log::info($appsDeveloper);
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
    // public function allApps(){
    //     $all_apps_get = list_apps::count();
    //     log::info($all_apps_get);
    //     $app_scap=list_apps::where('status','scraped')->count();
    //     $app_not_scap=list_apps::where('status','not scraped')->count();

    //     $apps = App::all();

    //     return inertia::render('Dashboard',[
    //         'all_apps'=>$all_apps_get,
    //         'apps_scraped'=>$app_scap,
    //         'apps_not_scraped'=>$app_not_scap,
    //         'apps' => $apps,
    //     ]);

    // }

    // public function addApp(Request $request)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'url' => 'required|url',
    //     ]);
    
    //     // Create data array
    //     $data = [
    //         'url' => $request->input('url'),
    //         'status' => 'not scraped',
    //     ];
    //     Log::info($data);
    
    //     // Create and save the list_apps model
    //     $list_apps = new list_apps($data);
    //     $list_apps->save();
    
    //     return to_route('dashboard');
    // }
    // public function destroy($appId){
    //     $desc = Description::where('app_id', $appId)->delete();
    //     $price = Tarif::where('app_id', $appId)->delete();
    //     $url = list_apps::where('id', $appId)->delete();
   
    //     $app = App::findOrFail($appId); // Find the item by ID
    //     $app->delete(); // Delete the item
    //     $desc = Description::findOrFail($appId);
    //     $desc->delete(); // Delete the item
    //     $price = Tarif::findOrFail($appId);
    //     $price->delete(); // Delete the item
    //     $url = list_apps::findOrFail($appId);
    //     $url->delete(); // Delete the item

    //     return redirect()->route('items.index')
    //         ->with('success', 'Item deleted successfully');
    
    // }
}
