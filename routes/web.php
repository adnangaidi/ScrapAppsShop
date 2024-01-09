<?php

use App\Http\Controllers\ChatgptController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScrapController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/',[HomeController::class,'getApps'])->name('apps.show');
Route::get('/app/{appId}',[HomeController::class,'getApp'])->name('app.show');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::inertia('/app/{appId}', 'SingleApp');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test',[ChatgptController::class,'addata']);
Route::get('test1',[HomeController::class,'getCategories']);
Route::get('/delete',[ScrapController::class,'deleteE']);

require __DIR__.'/auth.php';
