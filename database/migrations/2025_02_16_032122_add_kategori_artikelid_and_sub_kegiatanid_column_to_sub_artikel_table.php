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
            Schema::table('artikel', function (Blueprint $table) {
                $table->unsignedBigInteger('kategoriartikelid')->nullable()->after('konten');
                $table->foreign('kategoriartikelid')->references('id')->on('kategori_artikel')->onDelete('set null');
                
                $table->unsignedBigInteger('subkegiatanid')->nullable()->after('gambar');
                $table->foreign('subkegiatanid')->references('id')->on('sub_kegiatan')->onDelete('set null');                
    
            });
 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artikel', function (Blueprint $table) {
            $table->dropColumn('kategoriartikelid');
            $table->dropColumn('subkegiatanid');
        });
    }
};
