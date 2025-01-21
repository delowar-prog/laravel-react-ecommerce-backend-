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
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'brand_id' => $this->brand_id,
            'brand' => $this->brand?->brandName,
            'category_id' => $this->category_id,
            'category' => $this->category?->name,
                ];
    }
}
