<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::filter($request);
        $products = ProductResource::collection($products->paginate(10))->response()->getData();
      return ApiResponseService::success($products, 'Product retrived successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filepath = 'uploads/products';

            $data['image'] = $file->storeAs($filepath, $filename, 'public');
        }

        $product = Product::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Product created successfully',
            'data' => new ProductResource($product),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json([
            'status' => true,
            'message' => 'Brand Retrive successfully',
            'data' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $product->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully',
            'data' => $product,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Check if the product has an image and delete it from storage
        if ($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
        }

        // Delete the product from the database
        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product and associated image deleted successfully',
        ]);
    }
}
