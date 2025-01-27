<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::filter($request);
        
        if ($request->boolean('all', false)) {
            return ApiResponseService::success($categories->get(['id', 'name']), 'Categories retrieve successfully');
        }
        $categories = CategoryResource::collection($categories->paginate())->response()->getData();
      return ApiResponseService::success($categories, 'Category retrived successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        
        $category = Category::create($request->validated());
        return response()->json([
            'status' =>true,
            'message' =>'Category created successfully',
            'data' =>$category,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            'status' =>true,
            'message' =>'Category retrive successfully',
            'data' =>$category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $category->update($request->validated());
        return response()->json([
            'status' =>true,
            'message' =>'Category updated successfully',
            'data' =>$category,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'status' =>true,
            'message' =>'Category deleted successfully',
        ]);
    }
}
