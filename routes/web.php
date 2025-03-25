<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::all();
    return view('product.index')->with(['products' => $products]);
});

Route::get('/bootstrap', function () {
    return view('welcome');
});

Route::get('/product_add', function () {
    return view('product_add');
});


Route::resource("/product", ProductController::class);

Route::resource('/category', CategoryController::class);
