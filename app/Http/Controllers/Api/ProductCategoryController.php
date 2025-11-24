<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $categories = ProductCategory::all();
        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);

        } catch(\Exception $e){
            return response()->json([
                'type'=>$e->getMessage(),
                'data'=>null
            ]);
        }
        
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
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);
            $category = ProductCategory::create($request->all());
    
            return response()->json([
                'success' => true,
                'data' => $category
            ], 201);

        } catch(\Exception $e){
            return response()->json([
                'type'=>$e->getMessage(),
                'data'=>null
            ]);
        }
       
    }

    public function show($id)
    {
        try{
            $category = ProductCategory::find($id);
            return response()->json([
                'success' => true,
                'data' => $category
            ], 200);
        } catch(\Exception $e){
            return response()->json([
                'type'=>$e->getMessage(),
                'data'=>null,
                'message' => 'Category not found'
            ]);
        }
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
    public function update(Request $request, $id)
    {
        try{
            $product_category = ProductCategory::find($id);
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);
            $product_category->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $product_category
            ], 200);

        } catch(\Exception $e){
            return response()->json([
                'type'=>$e->getMessage(),
                'data'=>null
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $product_category)
    {
        try{
            $product_category->delete();
            return response()->json([
                'success' => true,
                'data'=> $product_category,
                'message' => 'Product category deleted successfully'
        ], 200);

        } catch(\Exception $e){
            return response()->json([
                'type'=>$e->getMessage(),
                'data'=>null
            ]);
        }
    }
}
