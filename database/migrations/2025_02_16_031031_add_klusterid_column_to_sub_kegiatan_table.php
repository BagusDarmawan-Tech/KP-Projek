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
        Schema::table('sub_kegiatan', function (Blueprint $table) {
            $table->unsignedBigInteger('klusterid')->nullable()->after('id');
            $table->foreign('klusterid')->references('id')->on('kluster')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_kegiatan', function (Blueprint $table) {
            $table->dropColumn('klusterid');
        });
    }
};
