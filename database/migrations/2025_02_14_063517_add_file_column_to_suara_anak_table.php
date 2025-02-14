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
            $table->string('file')->nullable()->after('tanggal'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suara_anak', function (Blueprint $table) {
            $table->dropColumn('file');
        });
    }
};
