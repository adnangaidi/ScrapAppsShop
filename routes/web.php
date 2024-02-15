<?php

use App\Http\Controllers\ChatgptController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScrapController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/',[HomeController::class,'getApps'])->name('/');
Route::get('/company/about', [HomeController::class,'about'])->name('apps.about');
Route::get('/company/contact', [HomeController::class,'contact'])->name('apps.contact');
Route::get('/categories/{category}', [HomeController::class,'getAppsWithCategory'])->name('category.show');
Route::get('/subcategories/{subcategory}', [HomeController::class,'getAppsWithSubCategory'])->name('subcategory.show');
// Route::get('/subcategories/{subcategory}', [HomeController::class,'getAppsWithSubCategory'])->name('subcategory.show');

Route::get('/{slug}',[HomeController::class,'getApp'])->name('app.show');






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('test1',[HomeController::class,'getCategories']);
// Route::get('/delete',[ScrapController::class,'deleteE']);

// require __DIR__.'/auth.php';
