<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $invoices = InvoiceResource::collection(Invoice::paginate())->response()->getData();
        return ApiResponseService::success($invoices, 'Invoices retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request): JsonResponse
    {
        $data = $request->validated();
        $invoice = Invoice::create($data);

       return response()->json([
        'status' => true,
        'message' => 'Success',
        'data' => $data,
       ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice): JsonResponse
    {
        return ApiResponseService::success($invoice, 'Invoices retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice): JsonResponse
    {
        $data = $request->validated();
        $invoice->update($data);

        return ApiResponseService::success($invoice, 'Invoices updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice): JsonResponse
    {
        $invoice->delete();

        return ApiResponseService::success(
            null,
            'Invoice deleted successfully',
            Response::HTTP_OK
        );
    }
}
