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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id');
            $table->string('store')->nullable();
            $table->string('contry')->nullable();
            $table->string('nb_start')->nullable(); 
            $table->string('content')->nullable(); 
            $table->string('date')->nullable();
            $table->string('used_period')->nullable();
            $table->string('reply')->nullable();
            $table->string('date_reply')->nullable();
            $table->unsignedBigInteger('app_id')->nullable();
            $table->foreign('app_id')->references('app_id')->on('apps');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
