<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'details' => $this->details,
            'status' => $this->status,
            'image' => $this->getFirstMediaUrl('main_image'),
            // 'images' => $this->images,
            'category_id' => $this->category_id,
            'category_name' => $this->category?->name,
            'price' => (int) $this->price,
            'quantity' => $this->quantity,
            'is_special' => $this->is_special,
            'created_at' => $this->created_at->format('Y-m-d')
        ];
    }
}
