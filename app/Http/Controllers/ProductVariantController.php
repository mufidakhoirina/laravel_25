<?php
// app/Http/Controllers/ProductVariantController.php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductVariantController extends Controller
{
    public function index(): JsonResponse
    {
        $variants = ProductVariant::all();
        
        return response()->json([
            'success' => true,
            'data' => $variants
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0'
        ]);

        $variant = ProductVariant::create($validated);

        return response()->json([
            'success' => true,
            'data' => $variant->load('product'),
            'message' => 'Product variant created successfully'
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $variant = ProductVariant::find($id);

        if (!$variant) {
            return response()->json([
                'success' => false,
                'message' => 'Product variant not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $variant
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $variant = ProductVariant::find($id);

        if (!$variant) {
            return response()->json([
                'success' => false,
                'message' => 'Product variant not found'
            ], 404);
        }

        $validated = $request->validate([
            'product_id' => 'sometimes|exists:products,id',
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0'
        ]);

        $variant->update($validated);

        return response()->json([
            'success' => true,
            'data' => $variant->load('product'),
            'message' => 'Product variant updated successfully'
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $variant = ProductVariant::find($id);

        if (!$variant) {
            return response()->json([
                'success' => false,
                'message' => 'Product variant not found'
            ], 404);
        }

        $variant->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product variant deleted successfully'
        ]);
    }
}