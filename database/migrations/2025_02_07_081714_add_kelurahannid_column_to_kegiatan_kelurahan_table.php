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
            $table->unsignedBigInteger('kelurahanid')->after('id');
            $table->foreign('kelurahanid')->references('id')->on('kelurahan');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan_kelurahan', function (Blueprint $table) {
            $table->dropColumn('kelurahanid');

        });
    }
};
