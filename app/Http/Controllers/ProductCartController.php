<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCartRequest;
use App\Http\Requests\UpdateProductCartRequest;
use App\Http\Resources\ProductCartResource;
use App\Models\ProductCart;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = ProductCartResource::collection(ProductCart::paginate())->response()->getData();
        return ApiResponseService::success($carts, 'Product Carts retrieved successfully', Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCartRequest $request)
    {
        $cart = ProductCart::create($request->validated());
        return ApiResponseService::success(new ProductCartResource($cart), 'Product Cart stored successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cart = ProductCart::find($id);
        return ApiResponseService::success(new ProductCartResource($cart), 'Product Cart retrieved successfully', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCartRequest $request, string $id)
    {
        $cart = ProductCart::find($id);
        $cart->update($request->validated());
        return ApiResponseService::success(new ProductCartResource($cart), 'Product Cart updated successfully', Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = ProductCart::find($id);
        $cart->delete();
        return ApiResponseService::success(null, 'Product Cart deleted successfully', Response::HTTP_OK);
    }
}
