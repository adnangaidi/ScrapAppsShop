<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\HomeController;


use Illuminate\Support\Facades\Route;



Route::controller(HomeController::class)->group(function () {
    Route::get('/','getApps')->name('/');
    Route::get('/search','search')->name('home');
    Route::get('/categories/{category}', 'getAppsWithCategory')->name('category.show');
    Route::get('/subcategories/{subcategory}', 'getAppsWithSubCategory')->name('subcategory.show');
    Route::get('/developer/{developer}', 'getAppsDeveloper')->name('developer.show');
    Route::get('/{slug}', 'getApp')->name('app.show');
});

Route::controller(contactController::class)->group(function () {
    Route::get('/company/contact', 'contact')->name('apps.contact');
    Route::post('/contact','send')->name('contact.post');
});

Route::get('/company/about', [AboutController::class,'about'])->name('apps.about');




