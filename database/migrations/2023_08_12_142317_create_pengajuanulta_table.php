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
        Schema::create('pengajuanulta', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->bigInteger('nim');
            $table->string('nama');
            $table->enum('jurusan', ['sipil', 'elektro', 'informatika', 'sistem_informasi']);
            $table->date('tgl_pengumpulan');
            $table->string('judul_ta');
            $table->string('nm_pembimbing1');
            $table->string('nm_pembimbing2');
            $table->string('tgl_sidangta');
            $table->string('file_laporanaplikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuanulta');
    }
};
