<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'title' => 'sometimes|string|max:255',
            'short_des' => 'nullable|string',
            'price' => 'sometimes|numeric',
            'discount' => 'nullable|numeric|min:0|max:100',
            'discount_price' => 'nullable|numeric',
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:4096',
            'stock' => 'sometimes|integer|min:0',
            'star' => 'nullable|numeric|min:0|max:5',
            'remarks' => 'nullable|string',
            'category_id' => 'sometimes|exists:categories,id',
            'brand_id' => 'sometimes|exists:brands,id',
        ];
    }
}
