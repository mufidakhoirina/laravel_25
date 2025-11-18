<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|JsonResponse
    {
        $vendors = Vendor::paginate(15);
        
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $vendors
            ]);
        }
        
        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'contact_person' => 'nullable|string|max:255',
        ]);

        try {
            $vendor = Vendor::create($validated);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Vendor created successfully',
                    'data' => $vendor
                ], 201);
            }
            
            return redirect()->route('vendors.index')
                           ->with('success', 'Vendor created successfully');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error creating vendor: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->withInput()
                        ->with('error', 'Error creating vendor: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $vendor
            ]);
        }
        
        return view('vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor): View
    {
        return view('vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email,' . $vendor->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'contact_person' => 'nullable|string|max:255',
        ]);

        try {
            $vendor->update($validated);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Vendor updated successfully',
                    'data' => $vendor->fresh()
                ]);
            }
            
            return redirect()->route('vendors.index')
                           ->with('success', 'Vendor updated successfully');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating vendor: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->withInput()
                        ->with('error', 'Error updating vendor: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor): RedirectResponse|JsonResponse
    {
        try {
            $vendor->delete();
            
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Vendor deleted successfully'
                ]);
            }
            
            return redirect()->route('vendors.index')
                           ->with('success', 'Vendor deleted successfully');
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error deleting vendor: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Error deleting vendor: ' . $e->getMessage());
        }
    }
}
