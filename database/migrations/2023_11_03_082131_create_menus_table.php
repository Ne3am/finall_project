<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('category');
            $table->integer('price');
            $table->integer('calories');
            $table->string('gluten');
            $table->string('Vegetarian');
            $table->string('Kidney_friendly');
            $table->string('Carbohydrate');
            $table->string('quantity_Carbohydrate');
            $table->string('image');
            $table->longText('component');
            $table->integer('evaluation')->default(0);
            $table->integer('quantity_sell')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
