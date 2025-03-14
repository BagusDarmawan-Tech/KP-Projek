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
        Schema::create('forum_anak', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('caption');
            $table->text('deskripsi');
            $table->string('dibuatOleh');
            $table->string('gambar');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_anak');
    }
};
