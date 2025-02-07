<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('dokumen_kelurahan', function (Blueprint $table) {
            $table->unsignedBigInteger('kelurahanid')->after('id');
            $table->foreign('kelurahanid')->references('id')->on('kelurahan');

            $table->unsignedBigInteger('jenis_suratid')->after('id');
            $table->foreign('jenis_suratid')->references('id')->on('jenis_surat');
        });
    }

    public function down()
    {
        Schema::table('dokumen_kelurahan', function (Blueprint $table) {
            $table->dropColumn('kelurahanid');
            $table->dropColumn('jenis_suratid');
        });
    }
};
