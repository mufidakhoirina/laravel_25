<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::all();
        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string'
    ]);

    $category = ProductCategory::create($request->all());

    return response()->json([
        'success' => true,
        'data' => $category
    ], 201);
    }

    /**
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = ProductCategory::find($id);

    if (!$category) {
        return response()->json([
            'success' => false,
            'message' => 'Category not found'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $category
    ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $product_category)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string'
        ]);
        $product_category->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $product_category
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $product_category)
    {
        $product_category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Product category deleted successfully'
        ], 200);
    }
}
