<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia, TranslatableContract
{
    use HasFactory, InteractsWithMedia, Translatable;

    protected $fillable = ['category_id', 'price', 'quantity', 'is_special', 'status', 'product_id'];

    public $translatedAttributes = ['name', 'description', 'details'];

    protected $hidden = ['updated_at', 'translations'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00'
    ];

    // public $appends = ['images'];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main_image');
        $this->addMediaCollection('product_images');
    }


    /// accessor
    // public function getImagesAttribute()
    // {
    //     $product_images = $this->getMedia('product_images');
    //     $images = array();
    //     for ($i = 0; $i < sizeof($product_images); $i++) {
    //         $images[$i] = $product_images[$i]->getUrl();
    //     }
    //     return $images;
    // }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function main_product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }


    public function scopeByCategory($query, $id)
    {
        return $query->where('category_id', $id);
    }

    public function scopeIsSpecial($query)
    {
        return $query->where('is_special', 1);
    }
}
