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
        Schema::table('kategori_artikel', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('slider', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('halaman', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('kluster', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('galeri_anak', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('forum_anak', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('sub_kegiatan', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });
        Schema::table('artikel', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('id');
            $table->foreign('dibuatOleh')->references('id')->on('users');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori_artikel', function (Blueprint $table) {
            $table->dropForeign(['dibuatOleh']); 
            $table->dropColumn('dibuatOleh');
        });
        Schema::table('slider', function (Blueprint $table) {
            $table->dropForeign(['dibuatOleh']); 
            $table->dropColumn('dibuatOleh');
        });
        Schema::table('halaman', function (Blueprint $table) {
            $table->dropForeign(['dibuatOleh']); 
            $table->dropColumn('dibuatOleh');
        });
        Schema::table('kluster', function (Blueprint $table) {
            $table->dropForeign(['dibuatOleh']); 
            $table->dropColumn('dibuatOleh');
        });
        Schema::table('galeri_anak', function (Blueprint $table) {
            $table->dropForeign(['dibuatOleh']); 
            $table->dropColumn('dibuatOleh');
        });
        Schema::table('forum_anak', function (Blueprint $table) {
            $table->dropForeign(['dibuatOleh']); 
            $table->dropColumn('dibuatOleh');
        });
        Schema::table('sub_kegiatan', function (Blueprint $table) {
            $table->dropForeign(['dibuatOleh']); 
            $table->dropColumn('dibuatOleh');
        });
        Schema::table('artikel', function (Blueprint $table) {
            $table->dropForeign(['dibuatOleh']); 
            $table->dropColumn('dibuatOleh');
        });
    }
};
