<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductDetailRequest extends FormRequest
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
            'product_id' => 'nullable|integer',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'img1' => 'nullable|file|mimes:jpeg,png,jpg|max:2048', // Optional in update
            'img2' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'img3' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'img4' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    
}
