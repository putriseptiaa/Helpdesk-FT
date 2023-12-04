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
        Schema::table('legalisasi', function (Blueprint $table) {
            $table->date('created_date')->after('jumlah');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('legalisasi', function (Blueprint $table) {
            $table->dropColumn('created_date');
            
        });
    }
};
