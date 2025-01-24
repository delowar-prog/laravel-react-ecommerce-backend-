<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'total' => $this->total,
            'vat' => $this->vat,
            'payable' => $this->payable,
            'cus_details' => $this->cus_details,
            'ship_details' => $this->ship_details,
            'transaction_id' => $this->transaction_id,
            'val_id' => $this->val_id,
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
