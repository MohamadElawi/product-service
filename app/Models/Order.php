<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable =['user_id','user_name','user_phone','user_email','total_amount'];

    protected $hidden =['updated_at'];

    public function Items(){
        return $this->hasMany(OrderItem::class);
    }
}