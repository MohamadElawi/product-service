<?php

namespace App\Http\Resources\Admin\Maintenance;

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
        return [
            'id' => $this->id,
            'service_id' => $this->servicee_id,
            'service_name' => $this->service_name,
            'user_id' => $this->user_id,
            'user_name' => $this->user_name,
            'user_email' => $this->user_email,
            'user_phone' => $this->user_phone,
            'description' => $this->description,
            'location' => $this->location,
            'street' => $this->street,
            'area' => $this->area,
            'status' => $this->status,
            'appointmant_at' => $this->appointment_at ,
            'created_at' => $this->created_at->format('Y-m-d H:i')
        ];
    }
}
