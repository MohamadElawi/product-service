<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    
    public function run()
    {
        $images = ['1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg'];

        
        for($i=0;$i<100;$i++){

            $category = Category::inRandomOrder()->first();
            $product =Product::create([
                'price'=> rand(1000,1000000),
                'quantity' => rand(10,50),
                'is_special' => 0 ,
                'category_id' => $category->id ,
            ]);
            $counter = $i+1 ;
            $product->translateOrnew('en')->name = "Product $counter" ;
            $product->translateOrnew('en')->description = "description for Product $counter" ;
            $product->translateOrnew('en')->details = "details for Product $counter" ;
            $product->addMediaFromUrl(asset("/faker_images/product/".$images[rand(0,9)]))->toMediaCollection('main_image','product');
            $product->save();
        }
    }
}
