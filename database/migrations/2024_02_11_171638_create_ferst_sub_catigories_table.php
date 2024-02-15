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
        Schema::create('ferst_sub_catigories', function (Blueprint $table) {
            $table->id('fsc_id');
            $table->string('name');
            $table->string('url');
            $table->unsignedBigInteger('cp_id')->nullable();
            $table->foreign('cp_id')->references('cp_id')->on('category_parents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ferst_sub_catigories');
    }
};
