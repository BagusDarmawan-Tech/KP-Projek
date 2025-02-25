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
        Schema::table('usulan', function (Blueprint $table) {
            $table->unsignedBigInteger('opdId')->nullable()->after('id');
            $table->foreign('opdId')->references('id')->on('opd');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usulan', function (Blueprint $table) {
            $table->dropForeign(['opdId']); 
            $table->dropColumn('opdId');
        });
    }
};
