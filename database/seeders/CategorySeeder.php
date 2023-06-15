<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
   
    public function run()
    {

        $images = ['1.png','2.jpg','3.jpg','4.jpg'];

        for($i=0;$i<10;$i++){
            $category =Category::create([]);
            $counter = $i+1 ;
            $category->translateOrnew('en')->name = "category $counter" ;
            $category->translateOrnew('en')->description = "description for category $counter" ;
            $category->addMediaFromUrl(asset("/faker_images/category/".$images[rand(0,3)]))->toMediaCollection('images','category');
            $category->save();
        }
    }
}
