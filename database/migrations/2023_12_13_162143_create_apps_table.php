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
        Schema::create('apps', function (Blueprint $table) {
            $table->id('app_id');
            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->string('video')->nullable();
            $table->string('developer')->nullable();
            $table->string('nb_review')->nullable();
            $table->string('date_created')->nullable();
            $table->string('langue')->nullable();
            $table->json('categories')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apps');
    }
};
