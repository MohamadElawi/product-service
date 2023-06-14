<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia, TranslatableContract
{
    use HasFactory, InteractsWithMedia, Translatable;

    protected $fillable = ['status'];

    // public $appends=['image'];

    public $translatedAttributes = ['name', 'description'];

    protected $hidden = ['updated_at','translations'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00'
    ];

    // public function getImageAttribute(){
    //     return $this->getFirstMediaUrl('images');
    // }

    public function products(){
        return $this->hasMany(Product::class);
    }


    public function scopeActive($query){
        return $query->where('status','active');
    }


}
