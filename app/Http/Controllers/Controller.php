<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function show($id) {
        $category = ProductCategory::with('products')->find($id);
        return response()->json($category);
    }   
}
