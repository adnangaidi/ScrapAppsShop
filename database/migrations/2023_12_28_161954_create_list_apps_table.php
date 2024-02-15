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
        Schema::create('list_apps', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique();
            $table->string('categories')->nullable();
            $table->string('subcategories')->nullable();
            $table->string('subcategories1')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_apps');
    }
};
