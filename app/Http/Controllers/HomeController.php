<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\App;
use App\Services\AppService;
use App\Services\HomeService;


class HomeController extends Controller
{
    protected $homeService;
    protected $appService;
    public function __construct(HomeService $homeService, AppService $appService)
    {
        $this->homeService = $homeService;
        $this->appService = $appService;
    }

    public function getApps()
    {
        $apps = $this->homeService->getHomeApps();
        return Inertia::render('Home', [
            'apps' => $apps,
        ]);
    }
    public function getApp($slug)
    {
        $data = $this->appService->getAppData($slug);
        return Inertia::render('SingleApp', [
            'app' => $data['app'],
            'role' => $data['role'],
            'price' => $data['price'],
            'url' => $data['url'],
            'media' => $data['media']
        ]);
    }

    public function getAppsWithCategory($category)
    {
        $appsCategories = App::filterByCategories($category);
        return Inertia::render('PageCategory', [
            'appsCategories' => $appsCategories,
        ]);
    }

    public function getAppsWithSubCategory($subcategory)
    {
        $appsCategories = App::filterBySubCategories($subcategory);

        return Inertia::render('PageCategory', [

            'appsCategories' => $appsCategories
        ]);
    }

    public function getAppsDeveloper($developer)
    {
        $appsDeveloper = App::filterByDeveloper($developer);

        return Inertia::render('PageCategory', [
            'appsCategories' => $appsDeveloper
        ]);
    }
    public function search()
    {
        return Inertia::render('PageCategory', [
            'appsCategories' => App::latest()->filter(request(['search']))->get(),
        ]);
    }
}
