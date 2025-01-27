<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = CustomerResource::collection(Customer::paginate())->response()->getData();
        return ApiResponseService::success($customers,'Customer Retrieved Successfullly');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->validated());
        return ApiResponseService::success(new CustomerResource($customer),"Customer Created Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return ApiResponseService::success(new CustomerResource($customer),"Customer Retrieve Successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return ApiResponseService::success(new CustomerResource($customer),"Customer Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return ApiResponseService::success(new CustomerResource($customer),"Customer Deleted Successfully");
    }
}
