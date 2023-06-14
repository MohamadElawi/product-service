<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->product->id,
            'name' => $this->product->name,
            'image' => $this->product->getFirstMediaUrl('images'),
        ];
    }
}
