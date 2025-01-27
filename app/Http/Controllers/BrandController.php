<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brands = Brand::filter($request);
        
        if ($request->boolean('all', false)) {
            return ApiResponseService::success($brands->get(['id', 'brandName']), 'brands retrieve successfully');
        }
        $brands = BrandResource::collection($brands->paginate(10))->response()->getData();
      return ApiResponseService::success($brands, 'Brand retrived successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('brandimg')) {
            $file = $request->file('brandimg');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filepath = 'uploads/brands';

            $data['brandimg'] = $file->storeAs($filepath, $filename, 'public');
        }

        $brand = Brand::create($data);

        return ApiResponseService::success( new BrandResource($brand), 'Brand stored successfully', Response::HTTP_ACCEPTED);
    }


    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {

        return ApiResponseService::success(new BrandResource($brand),'Brand retrieve successfully',Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand): JsonResponse
    {
        // Log incoming request data for debugging


        $data = $request->validated();

        if ($request->hasFile('brandimg')) {
            // Delete the old image if it exists
            if ($brand->brandImg && \Storage::disk('public')->exists($brand->brandImg)) {
                \Storage::disk('public')->delete($brand->brandImg);
            }

            // Save the new image
            $file = $request->file('brandimg');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filepath = 'uploads/brands';

            $data['brandImg'] = $file->storeAs($filepath, $filename, 'public');
        }

        // Update the brand
        $brand->update($data);

        return ApiResponseService::success(new BrandResource($brand), 'Brand updated successfully', Response::HTTP_OK);
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
