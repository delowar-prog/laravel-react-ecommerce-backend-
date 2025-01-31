<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'short_des' => 'nullable|string|max:500',
            'price' => 'required|numeric',
            'discount' => 'nullable|integer|min:0|max:100',
            'discount_price' => 'nullable|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
            'stock' => 'required|integer|min:0',
            'star' => 'nullable|numeric|min:0|max:5',
            'remarks' => 'nullable|in:new,sale,popular,featured,limited',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ];
    }
}
