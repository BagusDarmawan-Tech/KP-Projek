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
        Schema::table('karya_anak', function (Blueprint $table) {
            $table->boolean('status')->after('judul'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karya_anak', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
