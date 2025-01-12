<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductDetailRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductDetailRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductDetailResource;
use App\Models\ProductDetail;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = ProductDetailResource::collection(ProductDetail::paginate())->response()->getData();
        return ApiResponseService::success($products, 'Product Details retrived successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductDetailRequest $request)
    {
        $data = $request->validated();
    
        $imagePaths = []; // To store uploaded image paths
    
        // Process the required `img1`
        if ($request->hasFile('img1')) {
            $file = $request->file('img1');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filepath = 'uploads/products';
    
            $imagePaths['img1'] = $file->storeAs($filepath, $filename, 'public');
        }
    
        // Process the optional images
        foreach (['img2', 'img3', 'img4'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $file = $request->file($imageField);
                $filename = time() . '_' . $file->getClientOriginalName();
                $filepath = 'uploads/productDetails';
    
                $imagePaths[$imageField] = $file->storeAs($filepath, $filename, 'public');
            }
        }
    
        // Add image paths to the data array
        $data['images'] = json_encode($imagePaths); // Save as JSON
    
        // Store the product
        $product = ProductDetail::create($data);
    
        return ApiResponseService::success(
            new ProductDetailResource($product),
            'Product stored successfully',
            Response::HTTP_CREATED
        );
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = ProductDetail::findOrFail($id);
        return ApiResponseService::success(new ProductDetailResource($product),'Product retrieve successfully',Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductDetailRequest $request, string $id)
    {
        
        $data = $request->validated();
        
        $product = ProductDetail::findOrFail($id);
        $existingImages = json_decode($product->images, true) ?? [];
        $updatedImages = $existingImages;
    
        // Process each image field
        foreach (['img1', 'img2', 'img3', 'img4'] as $imageField) {
            if ($request->hasFile($imageField)) {
                // Delete the old image if it exists
                if (!empty($existingImages[$imageField]) && \Storage::disk('public')->exists($existingImages[$imageField])) {
                    \Storage::disk('public')->delete($existingImages[$imageField]);
                }
    
                // Save the new image
                $file = $request->file($imageField);
                $filename = time() . '_' . $file->getClientOriginalName();
                $filepath = 'uploads/productDetails';
    
                $updatedImages[$imageField] = $file->storeAs($filepath, $filename, 'public');
            }
        }
    
        $data['images'] = json_encode($updatedImages);
        
        $product->update($data);
    
        return ApiResponseService::success(
            new ProductDetailResource($product),
            'Product Details updated successfully',
            Response::HTTP_OK
        );
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
