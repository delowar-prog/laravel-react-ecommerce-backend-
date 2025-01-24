<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
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
            'total' => 'sometimes|numeric',
            'vat' => 'sometimes|numeric',
            'payable' => 'sometimes|numeric',
            'cus_details' => 'sometimes|string',
            'ship_details' => 'nullable|string',
            'transaction_id' => 'sometimes|string|unique:invoices,transaction_id,' . $this->route('invoice')->id,
            'val_id' => 'nullable|string',
            'status' => 'sometimes|string',
            'payment_status' => 'sometimes|string',
            'user_id' => 'sometimes|exists:users,id',
        ];
    }
}
