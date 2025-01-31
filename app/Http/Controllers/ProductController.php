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
        if ($request->boolean('all', false)) {
            return ApiResponseService::success($products->get(['id', 'title']), 'Products retrieve successfully');
        }
        $products = ProductResource::collection($products->paginate(30))->response()->getData();
      return ApiResponseService::success($products, 'Product retrived successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $data['image'];
            $filename = time().'_'.$image->getClientOriginalName();
            $filePath = $image->storeAs('products', $filename, 'public');
            $data['image'] = 'storage/' . $filePath;
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
            'data' => new ProductResource($product),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($data['image']) {
            // Delete the old image if it exists
            if ($product->image) {
                $existingPath = public_path($product->image);
                if (file_exists($existingPath)) {
                    unlink($existingPath);
                }
            }
            $image = $data['image'];
            $filename = time().'_'.$image->getClientOriginalName();
            $filePath = $image->storeAs('products', $filename, 'public');
            $data['image'] = 'storage/' . $filePath;
        }
        $product->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully',
            'data' => new ProductResource($product),
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
