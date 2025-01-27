<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'cus_name' => $this->cus_name,
            'cus_address' => $this->cus_address,
            'cus_country' => $this->cus_country,
            'cus_division' => $this->cus_division,
            'cus_district' => $this->cus_district,
            'cus_upazila' => $this->cus_upazila,
            'cus_post_code' => $this->cus_post_code,
            'cus_phone' => $this->cus_phone,
            'cus_email' => $this->cus_email,
            'ship_name' => $this->ship_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
