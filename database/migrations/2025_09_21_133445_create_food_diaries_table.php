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
        Schema::create('food_diaries', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // link diary to user
        $table->date('date'); // date of diary
        $table->string('meal_type'); // breakfast, lunch, dinner, snack
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_diaries');
    }
};
