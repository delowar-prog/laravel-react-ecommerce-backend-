<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::paginate();
        return response()->json([
            'status' =>true,
            'message' =>'Category retrived successfully',
            'data' =>$category,
        ]);
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
