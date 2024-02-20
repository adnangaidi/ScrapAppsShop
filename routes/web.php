<?php

use App\Http\Controllers\ChatgptController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::controller(HomeController::class)->group(function () {
    Route::get('/','getApps')->name('/');
    Route::get('/company/about', 'about')->name('apps.about');
    Route::get('/company/contact', 'contact')->name('apps.contact');
    Route::get('/categories/{category}', 'getAppsWithCategory')->name('category.show');
    Route::get('/subcategories/{subcategory}', 'getAppsWithSubCategory')->name('subcategory.show');
    Route::get('/developer/{developer}', 'getAppsDeveloper')->name('developer.show');
    Route::get('/{slug}', 'getApp')->name('app.show');
});
Route::post('/contact', [contactController::class, 'send'])->name('contact.post');

