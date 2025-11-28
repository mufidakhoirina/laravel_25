<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\ProductVariantController;

Route::prefix('v1')->group(function () {
    Route::resource('products', ApiProductController::class);
    Route::resource('product-categories', ProductCategoryController::class);
    Route::resource('product-variants', ProductVariantController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('product-categories', ProductCategoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('product-variants', ProductVariantController::class);
    Route::get('/halo', function () {
        return 'Halo, Laravel!';
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
