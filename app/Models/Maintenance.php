<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    //   protected $guarded=[];
    protected $fillable = ['user_id', 'service_id', 'description', 'location', 'street', 'area', 'status', 'appointment_at', 'price'];

    protected $hidden = ['updated_at'];

    public function appointment_dates()
    {
        return $this->hasMany(MaintenanceTime::class);
    }
}
