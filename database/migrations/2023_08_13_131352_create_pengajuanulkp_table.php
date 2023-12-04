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
        Schema::create('pengajuanulkp', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->bigInteger('nim');
            $table->string('nama');
            $table->enum('jurusan', ['sipil', 'elektro', 'informatika', 'sistem_informasi']);
            $table->date('tgl_pengumpulan');
            $table->string('judulkp');
            $table->string('instansi');
            $table->string('nm_pembimbing');
            $table->string('tgl_sidangkp');
            $table->string('file_laporanaplikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuanulkp');
    }
};
