<?php

namespace App\Http\Resources\Admin\Maintenance;

use Illuminate\Http\Resources\Json\JsonResource;

class indexResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'service_id' => $this->serveice_id,
            'user_id' => $this->user_id,
            'user_name' => $this->user_name,
            'user_email' => $this->user_email,
            'user_phone' => $this->user_phone,
            'status' => $this->status,
            'appointmant_at' => $this->appointment_at
        ];
    }
}
