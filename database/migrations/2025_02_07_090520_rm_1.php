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
        Schema::table('kegiatan_kelurahan', function (Blueprint $table) {
            $table->dropForeign(['kecamatanid']); // Hapus foreign key
            $table->dropColumn('kecamatanid');   // Hapus kolom
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan_kelurahan', function (Blueprint $table) {
            $table->unsignedBigInteger('kecamatanid')->after('id');
            $table->foreign('kecamatanid')->references('id')->on('kecamatan');
        });
    }
};
