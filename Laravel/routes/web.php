<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
Route::get('/', function () {
    return view('welcome');
});

//Route::get('/store-products', [ProductController::class, 'storeProducts']);
//Route::get('/categories-store', [CategoriesController::class, 'storeCategories']);
