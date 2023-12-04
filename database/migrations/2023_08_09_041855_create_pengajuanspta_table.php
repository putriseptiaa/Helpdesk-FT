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
        Schema::create('pengajuanspta', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('nama');
            $table->string('nohp');
            $table->bigInteger('nim');
            $table->enum('jurusan', ['sipil', 'elektro', 'informatika', 'sistem_informasi']);
            $table->date('tgl_pengajuan');
            $table->string('nm_pembimbing1');
            $table->string('nm_pembimbing2');
            $table->string('judul_prota');
            $table->string('berkas_penelitian');
            $table->string('transkip');
            $table->string('bukti_lapkp');
            $table->string('up_ombus');
            $table->string('up_pbn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuanspta');
    }
};
