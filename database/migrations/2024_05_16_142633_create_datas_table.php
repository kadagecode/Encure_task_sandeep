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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->enum('gender' , ['male' , 'female' , 'other'])->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('state');
            $table->string('city');
            $table->enum('branch' , ['Art' , 'Science' , 'Commerce']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datas');
    }
};
