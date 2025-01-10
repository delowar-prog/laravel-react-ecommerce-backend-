<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $brands = Brand::paginate();
        return response()->json([
            'status' => true,
            'message' => 'Brands retrieved successfully',
            'data' => $brands,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('brandImg')) {
            $data['brandImg'] = $request->file('brandImg')->store('uploads', 'public');
        }

        $brand = Brand::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Brand created successfully',
            'data' => new BrandResource($brand),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return response()->json([
            'status' => true,
            'message' => 'Brand retrive successfully',
            'data' => $brand,
        ]);
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand): JsonResponse
    {
        $brand->delete();
        return response()->json([
            'status' => true,
            'message' => 'Brand deleted successfully',
        ]);
    }
}
