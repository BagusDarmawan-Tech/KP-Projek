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
        Schema::table('suara_anak', function (Blueprint $table) {
            $table->date('tanggalTindakLanjut')->nullable()->after('tanggal'); 
            $table->text('tindakLanjut')->nullable()->after('tanggal');         });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suara_anak', function (Blueprint $table) {
            $table->dropColumn('tanggalTindakLanjut');
            $table->dropColumn('tindakLanjut');
        });
    }
};
