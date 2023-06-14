<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id ,
            'name'=>$this->name ,
            'description'=>$this->description ,
            'details'=>$this->details ,
            'status'=>$this->status ,
            'image'=>$this->getFirstMediaUrl('images'),
            'category_id'=>$this->category_id ,
            'category_name'=>$this->category?->name ,
            'prcie'=>$this->price ,
            'is_special'=>$this->is_special ,
        ];
    }
}
