<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'cus_name' => 'required|string|max:255',
            'cus_address' => 'required|string|max:255',
            'cus_country' => 'required|string|max:255',
            'cus_division' => 'required|string|max:255',
            'cus_district' => 'required|string|max:255',
            'cus_upazila' => 'required|string|max:255',
            'cus_post_code' => 'required|string|max:10',
            'cus_phone' => 'required|string|max:15',
            'cus_email' => 'required|email|unique:customers,cus_email',
            'ship_name' => 'required|string|max:255',
        ];
    }
}
