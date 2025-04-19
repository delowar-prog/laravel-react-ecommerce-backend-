<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\AuthContorller;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProductWishController;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

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
Route::delete('/product-carts/clear', [ProductCartController::class, 'clearCart']);
Route::apiResource('customers',CustomerController::class);
});
Route::get('/user', [AuthContorller::class, 'user']);


Route::get('divisions', [LocationController::class, 'getDivisions']);
Route::get('districts', [LocationController::class, 'getDistricts']);
Route::get('upazilas', [LocationController::class, 'getUpazilas']);
Route::get('unions', [LocationController::class, 'getUnions']);


Route::post('/register', [AuthContorller::class, 'register']);
Route::post('/login', [AuthContorller::class, 'login']);
//after login
Route::post('/logout', [AuthContorller::class, 'logout'])->middleware('auth:sanctum');

    Route::post('refresh-token', [AuthContorller::class, 'refreshToken']);
        

Route::middleware('auth:sanctum')->get('/user', [AuthContorller::class, 'user']);
Route::apiResource('invoices', InvoiceController::class);

Route::apiResource('products', ProductController::class);
Route::post('products/{product}',[ProductController::class,'update']);

use App\Http\Controllers\BkashController;

Route::post('bkash/get-token', [BkashController::class, 'getToken'])->name('bkash-get-token');
Route::post('bkash/create-payment', [BkashController::class, 'createPayment'])->name('bkash-create-payment');
Route::post('bkash/execute-payment', [BkashController::class, 'executePayment'])->name('bkash-execute-payment');
Route::get('bkash/query-payment/{paymentID}', [BkashController::class, 'queryPayment'])->name('bkash-query-payment');
Route::post('bkash/success', [BkashController::class, 'bkashSuccess'])->name('bkash-success');


