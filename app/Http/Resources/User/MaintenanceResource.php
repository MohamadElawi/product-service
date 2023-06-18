<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceResource extends JsonResource
{
 
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'service_id' => $this->serveice_id,
            'description' => $this->description,
            'location' => $this->location,
            'street' => $this->street,
            'area' => $this->area,
            'status' => $this->status,
            'appointmant_at' => $this->appointment_at
        ];
    }
}
