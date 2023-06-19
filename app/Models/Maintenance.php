<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    //   protected $guarded=[];
    protected $fillable = ['user_id', 'user_name', 'user_phone', 'user_email', 'service_id','service_name', 'description', 'location', 'street', 'area', 'status', 'appointment_at', 'price'];

    protected $hidden = ['updated_at'];

    public function appointment_dates()
    {
        return $this->hasMany(MaintenanceTime::class);
    }
}
