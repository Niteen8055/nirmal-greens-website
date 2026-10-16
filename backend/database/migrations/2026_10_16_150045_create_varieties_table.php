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
        Schema::create('varieties', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('latin')->nullable();
            $table->unsignedSmallInteger('grow_days');
            $table->unsignedInteger('yield_min_g')->nullable();
            $table->unsignedInteger('yield_max_g')->nullable();
            $table->string('tag')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varieties');
    }
};
