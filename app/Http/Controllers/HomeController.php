<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Models\App;
use App\Models\Description;
use App\Models\list_apps;
use App\Models\Tarif;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function getApps()
    {
        $apps = App::all();
        $categories = App::all()->pluck('categories');
        $results = [];

        for ($i = 0; $i < count($categories); $i++) {
            $values = is_null($categories) ? '' : array_map('trim', explode(",", $categories[$i]));
            $results = array_merge($results, $values);
        }

        $results = array_unique($results);
        Log::info($results);
        Log::info($apps);

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'apps' => $apps,
            'categories' => $results
        ]);
    }
    public function getApp($appId)
    {

        $app = App::find($appId);
        $desc = Description::where('app_id', $appId)->first();
        $desc_array = is_null($desc) ? '' : array_map('trim', explode(",", $desc['role']));
        $price = Tarif::where('app_id', $appId)->get();
        $url = list_apps::where('app_id', $appId)->where('status', 'scraped')->get('url');
        $result_price = [];

        for ($i = 0; $i < count($price); $i++) {
            $value = [
                "name" => $price[$i]['name'],
                "id" => "tier-" . strtolower($price[$i]['name']),
                "href" => "#",
                "price" => str_replace('/month', '', $price[$i]['price']),
                "plan" => explode(',', $price[$i]['plan'])
            ];

            $result_price[] = $value;
        }

        $categorie = is_null($app) ? '' : array_map('trim', explode(",", $app['categories']));
        Log::info($app);
        Log::info($result_price);
        Log::info($desc);
        Log::info($desc_array);
        Log::info($categorie);
        Log::info($url);


        return Inertia::render('SingleApp', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'app' => $app,
            'categorie' => $categorie,
            'description' => $desc,
            'role' => $desc_array,
            'price' => $result_price,
            'url' => $url
        ]);
    }
}
