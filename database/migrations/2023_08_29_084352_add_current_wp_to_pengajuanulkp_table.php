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
        Schema::table('pengajuanulkp', function (Blueprint $table) {
            $table->integer('current_wp')->nullable()->default('1')->after('file_laporanaplikasi');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuanulkp', function (Blueprint $table) {
            $table->dropColumn('current_wp');
            
        });
    }
};
