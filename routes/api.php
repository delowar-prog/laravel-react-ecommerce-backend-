<?php

use App\Http\Controllers\AuthContorller;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

Route::post('/logout', [AuthContorller::class, 'logout']);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('brands', BrandController::class);
});
Route::get('/user', [AuthContorller::class, 'user']);

Route::post('/register', [AuthContorller::class, 'register']);
Route::post('/login', [AuthContorller::class, 'login']);
//after login
Route::post('/logout', [AuthContorller::class, 'logout'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', [AuthContorller::class, 'user']);

Route::apiResource('categories', CategoryController::class);
Route::apiResource('brands', BrandController::class);
Route::apiResource('products', ProductController::class);
