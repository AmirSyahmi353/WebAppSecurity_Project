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
        Schema::create('food_items', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('food_diary_id'); // belongs to diary
        $table->string('food_name'); // nasi lemak, roti canai, etc.
        $table->string('portion');   // 1 plate, 1 glass, etc.
        $table->string('image_path')->nullable(); // picture for dietitian
        $table->timestamps();

        $table->foreign('food_diary_id')->references('id')->on('food_diaries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_items');
    }
};
