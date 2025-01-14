<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductWishRequest;
use App\Http\Requests\UpdateProductWishRequest;
use App\Http\Resources\ProductWishResource;
use App\Models\ProductWish;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductWishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishes = ProductWishResource::collection(ProductWish::paginate())->response()->getData();
        return ApiResponseService::success($wishes, 'Product Wishes retrieved successfully', Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductWishRequest $request)
    {
        $wish = ProductWish::create($request->validated());
        return ApiResponseService::success(new ProductWishResource($wish), 'Product Wish stored successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $wish = ProductWish::find($id);
        return ApiResponseService::success(new ProductWishResource($wish), 'Product Wish retrieved successfully', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductWishRequest $request, string $id)
    {
        $wish = ProductWish::find($id);
        $wish->update($request->validated());
        return ApiResponseService::success(new ProductWishResource($wish), 'Product Wish updated successfully', Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wish = ProductWish::find($id);
        $wish->delete();
        return ApiResponseService::success(null, 'Product Wish deleted successfully', Response::HTTP_OK);
    }
}
