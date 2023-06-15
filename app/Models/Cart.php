<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable =['user_id' ,'product_id','quantity'];

    protected $hidden =['updated_at'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function scopeByUser($query ,$id){
        return $query->where('user_id',$id);
    }

    public function scopeByProduct($query ,$id){
        return $query->where('product_id',$id);
    }
}
