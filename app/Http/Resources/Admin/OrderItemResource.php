<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'product_name' => $this->product?->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at->format('Y-m-d h:mi'),
        ];
    }
}
