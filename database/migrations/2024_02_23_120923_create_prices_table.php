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
        Schema::dropIfExists('prices'); 
        Schema::create('prices', function (Blueprint $table) {
            $table->id('price_id');
            $table->string('name')->nullable();
            $table->string('price')->nullable();
            $table->unsignedBigInteger('app_id');
            $table->foreign('app_id')->references('app_id')->on('apps')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
