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
        Schema::create('kluster', function (Blueprint $table) {
            $table->id();
            $table->string('icon');
            $table->string('nama');
            $table->string('gambar');
            $table->string('slug');
            $table->string('dibuatOleh');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kluster');
    }
};
