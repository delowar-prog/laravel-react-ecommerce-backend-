<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductDetailRequest extends FormRequest
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
            'product_id' => 'required|integer',
            'color' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img1' => 'required|file|mimes:jpeg,png,jpg',
            'img2' => 'nullable|file|mimes:jpeg,png,jpg',
            'img3' => 'nullable|file|mimes:jpeg,png,jpg',
            'img4' => 'nullable|file|mimes:jpeg,png,jpg',
        ];
    }
}
