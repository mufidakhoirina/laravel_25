<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Api\ProductCategoryController;

Route::prefix('v1')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('product-categories', ProductCategoryController::class);
    Route::resource('vendors', VendorController::class);

    Route::get('/halo', function () {
        return 'Halo, Laravel!';
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
