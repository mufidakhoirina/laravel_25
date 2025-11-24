<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{
            $products = Product::all();
            return response()->json($products);
        } catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage(),
                'data'=>null
            ],401);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{
            $validatedData = $request->validate([
                'category_id'=>'required|exists:product_categories,id',
                'name' => 'required|max:255',
                'description' => 'required|nullable',
            ]);
            $product = Product::create($validatedData);
            return response()->json([
                'type'=>'succes',
                'data'=>$product,
            ], 201);

        } catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage(),
                'data'=>null
            ],401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try{
            $product=Product::findOrFail($id);
            return response()->json([
                'type'=>'succes',
                'data'=>$product
            ],201);
 
        } catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage(),
                'data'=>null
            ],401);
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
    public function update(Request $request, string $id)
    {
        //
        try{
            $product=Product::findOrFail($id);
            $validatedData = $request->validate([
                'category_id'=>'required|exists:product_categories,id',
                'name' => 'required|max:255',
                'description' => 'required|nullable',
            ]);
            $product -> update($validatedData);
            return response()->json([
                'type'=>'succes',
                'data'=>$product
            ], 201);

        } catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage(),
                'data'=>null
            ],401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try{
            $product=Product::findOrFail($id);
            $product -> delete();
            return response()->json([
                'type'=>'succes',
                'data'=>$product
            ], 201);

        } catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage(),
                'data'=>null
            ],401);
        }
    }
}
