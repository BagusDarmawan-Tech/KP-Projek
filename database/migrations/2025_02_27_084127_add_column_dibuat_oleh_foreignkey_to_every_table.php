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
        Schema::table('kegiatan_mitra_anak', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('artikel_mitra_anak', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('kegiatan_cfci', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('kegiatan_arek_suroboyo', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('karya_anak', function (Blueprint $table) {
            $table->unsignedBigInteger('pemohon')->nullable()->after('id');
            $table->foreign('pemohon')->references('id')->on('users');
        });
        Schema::table('suara_anak', function (Blueprint $table) {
            $table->unsignedBigInteger('pemohon')->nullable()->after('id');
            $table->foreign('pemohon')->references('id')->on('users');
        });
        Schema::table('dokumen_pisa', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('kegiatan_pisa', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('dokumen_kecamatan', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('dokumen_kelurahan', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('kegiatan_kelurahan', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('kegiatan_kecamatan', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
