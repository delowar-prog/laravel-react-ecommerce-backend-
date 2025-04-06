<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'total' => 'required|numeric',
            'vat' => 'required|numeric',
            'payable' => 'required|numeric',
            'cus_details' => 'required|array',
            'transaction_id' => 'required|string|unique:invoices',
            'val_id' => 'nullable|string',
            'status' => 'required|string',
            'payment_status' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
