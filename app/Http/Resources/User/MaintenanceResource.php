<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [ 'description'=> $this->description,
        'location'=> $this->location,
        'street'=> $this->street,
        'area'=> $this->area,
        'status'=> $this->status,
        'appointmant_at'=>$this->appointment];
    }
}
