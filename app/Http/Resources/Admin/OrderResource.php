<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id ,
            'user_id' => $this->user_id ,
            'user_name'=> $this->user_name ,
            'user_phone' => $this->user_phone ,
            'user_email' => $this->user_email ,
            'total_amount' => $this->total_amount ,
            'created_at' => $this->created_at->format('Y-m-d')
        ];
    }
}
