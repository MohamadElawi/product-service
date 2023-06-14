<?php

namespace App\Http\Resources\User\Product;

use App\Models\Favourite;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        $user = auth()->user();
        $favourite = Favourite::ByUser($user->id)->byProduct($this->id)->first();
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
            'is_favourite'=> $favourite != null ? 1 : 0 ,
        ];
    }
}
