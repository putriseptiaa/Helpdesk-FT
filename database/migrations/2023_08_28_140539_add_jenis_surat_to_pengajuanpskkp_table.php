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
        Schema::table('pengajuanpskkp', function (Blueprint $table) {
            $table->enum('jenis_surat', ['pskkp'])->after('jurusan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuanpskkp', function (Blueprint $table) {
            $table->dropColumn('jenis_surat');
            
        });
    }
};
