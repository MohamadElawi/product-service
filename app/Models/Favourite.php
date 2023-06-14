<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' ,'product_id'];
    protected $hidden = ['updated_id'] ;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function scopeByUser($query ,$user){
        return $query->where('user_id',$user);
    }

    public function scopeByProduct($query ,$product){
        return $query->where('product_id',$product);
    }

}
