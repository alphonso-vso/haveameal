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
        Schema::create('lunches', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->unsignedBigInteger('meal_id');
            $table->timestamps();
            
            $table->foreign('meal_id')->references('id')->on('meals')
            ->onDelete('restrict')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lunches');
    }
};
