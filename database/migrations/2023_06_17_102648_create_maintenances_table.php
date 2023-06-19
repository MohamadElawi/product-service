<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('service_id');
            $table->string('service_name');
            $table->integer('user_id');
            $table->string('user_name');
            $table->string('user_phone');
            $table->string('user_email');
            $table->longText('description');
            $table->string('location');
            $table->string('street');
            $table->string('area');
            $table->decimal('price', 12, 2)->nullable();
            $table->string('status')->default('pending');
            $table->date('appointment_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenances');
    }
};
