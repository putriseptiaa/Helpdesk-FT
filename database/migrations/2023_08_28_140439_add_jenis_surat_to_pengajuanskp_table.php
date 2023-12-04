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
        Schema::table('pengajuanskp', function (Blueprint $table) {
            $table->enum('jenis_surat', ['skp'])->after('jurusan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuanskp', function (Blueprint $table) {
            $table->dropColumn('jenis_surat');
            
        });
    }
};