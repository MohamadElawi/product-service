<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('favourites', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->foreignId('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('favourites');
    }
};
