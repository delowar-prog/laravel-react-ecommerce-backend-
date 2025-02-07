<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $this->image , // Add full URL for the image
            'category_id' => $this->category_id,
            'category' => $this->category?->name,
            'brand_id' => $this->brand_id,
            'brand' => $this->brand?->brandName,
            'star' => $this->star,
            'discount' => $this->discount,
            'discount_price' => $this->discount_price,
            'short_des' => $this->short_des,
            'remarks' => $this->remarks,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
