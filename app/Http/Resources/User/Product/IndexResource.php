<?php

namespace App\Http\Resources\User\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id ,
            'name'=>$this->name ,
            'image'=>$this->getFirstMediaUrl('main_image'),
            'price' => $this->price ,
        ];
    }
}
