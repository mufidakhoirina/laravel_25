<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{
            $variant = ProductVariant::all();
            return response()->json($variant);

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
                'product_id'=>'required|exists:products,id',
                'name' => 'required|max:255',
                'description' => 'required|nullable',
                'price' => 'required',
                'stock' => 'required',
            ]);
            $variant = ProductVariant::create($validatedData);
            return response()->json([
                'type'=>'succes',
                'data'=>$variant,
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
    public function show( $id)
    {
        //
        try{
            $variant=ProductVariant::findOrFail($id);
            return response()->json([
                'type'=>'succes',
                'data'=>$variant
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
            $variant=ProductVariant::findOrFail($id);
            $validatedData = $request->validate([
                'product_id'=>'required|exists:products,id',
                'name' => 'required|max:255',
                'description' => 'required|nullable',
                'price' => 'required',
                'stock' => 'required',
            ]);
            $variant -> update($validatedData);
            return response()->json([
                'type'=>'succes',
                'data'=>$variant,
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
            $variant=ProductVariant::findOrFail($id);
            $variant -> delete();
            return response()->json([
                'type'=>'succes',
                'data'=>$variant,
            ], 201);


        } catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage(),
                'data'=>null
            ],401); 
        } 
        
    }
}
