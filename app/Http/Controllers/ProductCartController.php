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
   
    public function index(Request $request)
    {
        $query = ProductCart::query();
    
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }
    
        $carts = ProductCartResource::collection($query->get());
        return ApiResponseService::success($carts, 'Product Carts retrieved successfully', Response::HTTP_OK);
    }
    

public function store(StoreProductCartRequest $request)
{
    $validated = $request->validated();

    // Check if the product already exists in the user's cart
    $existingCart = ProductCart::where('user_id', $validated['user_id'])
        ->where('product_id', $validated['product_id'])
        ->first();

    if ($existingCart) {
        $existingCart->quantity += $validated['quantity'];
        $existingCart->save();

        return ApiResponseService::success(
            new ProductCartResource($existingCart),
            'Cart updated successfully',
            Response::HTTP_OK
        );
    }

    $cart = ProductCart::create($validated);

    return ApiResponseService::success( new ProductCartResource($cart), 'Product Cart stored successfully', Response::HTTP_CREATED);
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
