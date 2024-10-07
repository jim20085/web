<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\UserController;


Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/home', [ProductController::class, 'getProductsById']);
Route::get('/categories', [CategoriesController::class, 'index']);
Route::post('/addcart', [CartItemController::class, 'store']);
Route::get('/cart',[CartItemController::class, 'index']);
Route::put('/cart/{id}/update', [CartItemController::class, 'updateQuantity']);
Route::delete('/cart/{id}/delete', [CartItemController::class, 'delete']);
Route::delete('/cart/deleteAll',[CartItemController::class, 'clearCart']);
Route::post('/register',[UserController::class, 'store']);

