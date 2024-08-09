<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('number')->unique();
            $table->longText('address')->nullable();
            $table->string('img')->default('photos\user-icon');
            $table->string('role');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
