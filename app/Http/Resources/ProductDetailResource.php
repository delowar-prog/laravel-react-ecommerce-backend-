<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        return [
            'id'          => $this->id,
            'product_id'  => $this->product_id,
            'product'     => $this->product?->title,
            'color'       => $this->color,
            'size'        => $this->size,
            'description' => $this->description,
            
                'img1' => $this->img1,
                'img2' => $this->img2,
                'img3' => $this->img3,
                'img4' => $this->img4
            
        ];
    }
}
