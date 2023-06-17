<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceTime extends Model
{
    use HasFactory;
    protected $fillable = ['maintenance_id', 'date'];
    protected $hidden = ['updated_at'];

    public function maintenance()
    {
        return $this->belongsTo(maintenance::class);
    }
}
