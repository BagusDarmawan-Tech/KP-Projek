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
        Schema::table('dokumen_kecamatan', function (Blueprint $table) {
            $table->unsignedBigInteger('kecamatanid')->after('id');
            $table->foreign('kecamatanid')->references('id')->on('kecamatan');

            $table->unsignedBigInteger('jenis_suratid')->after('id');
            $table->foreign('jenis_suratid')->references('id')->on('jenis_surat');
        });
    }

    public function down()
    {
        Schema::table('dokumen_kecamatan', function (Blueprint $table) {
            $table->dropColumn('kecamatanid');
            $table->dropColumn('jenis_suratid');
        });
    }
};
