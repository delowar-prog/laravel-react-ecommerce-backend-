<?php

use App\Http\Controllers\AuthContorller;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProductWishController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

Route::post('/logout', [AuthContorller::class, 'logout']);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('brands', BrandController::class);

Route::apiResource('product-details', ProductDetailController::class);
Route::get('product-details/{product_id}', [ProductDetailController::class, 'show']);
Route::apiResource('product-wishes', ProductWishController::class);
Route::apiResource('product-carts', ProductCartController::class);
Route::apiResource('customers',CustomerController::class);
});
Route::get('/user', [AuthContorller::class, 'user']);

Route::post('/register', [AuthContorller::class, 'register']);
Route::post('/login', [AuthContorller::class, 'login']);
//after login
Route::post('/logout', [AuthContorller::class, 'logout'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', [AuthContorller::class, 'user']);
Route::apiResource('invoices', InvoiceController::class);

Route::apiResource('products', ProductController::class);
Route::post('products/{product}',[ProductController::class,'update']);

