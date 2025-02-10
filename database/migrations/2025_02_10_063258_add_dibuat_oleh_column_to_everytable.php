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
        Schema::table('dokumen_pisa', function (Blueprint $table) {
            $table->string('dibuatOleh')->after('id');        });

        Schema::table('kegiatan_pisa', function (Blueprint $table) {
            $table->string('dibuatOleh')->after('id');
        });

        Schema::table('dokumen_kecamatan', function (Blueprint $table) {
            $table->string('dibuatOleh')->after('id');
        });
        Schema::table('kegiatan_kecamatan', function (Blueprint $table) {
            $table->string('dibuatOleh')->after('id');
        });
        
        Schema::table('dokumen_kelurahan', function (Blueprint $table) {
            $table->string('dibuatOleh')->after('id');
        });
        
        Schema::table('kegiatan_kelurahan', function (Blueprint $table) {
            $table->string('dibuatOleh')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumen_pisa', function (Blueprint $table) {
            $table->dropColumn('dibuatOleh');
        });
        Schema::table('kegiatan_pisa', function (Blueprint $table) {
            $table->dropColumn('dibuatOleh');
        });
        Schema::table('dokumen_kecamatan', function (Blueprint $table) {
            $table->dropColumn('dibuatOleh');
        });
        Schema::table('kegiatan_kecamatan', function (Blueprint $table) {
            $table->dropColumn('dibuatOleh');
        });
        Schema::table('dokumen_kelurahan', function (Blueprint $table) {
            $table->dropColumn('dibuatOleh');
        });
        Schema::table('kegiatan_kelurahan', function (Blueprint $table) {
            $table->dropColumn('dibuatOleh');
        });
    }
};
