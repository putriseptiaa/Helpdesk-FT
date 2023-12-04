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
        Schema::create('pengajuanpskkp', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('nama');
            $table->string('nohp');
            $table->bigInteger('nim');
            $table->enum('jurusan', ['sipil', 'elektro', 'informatika', 'sistem_informasi']);
            $table->date('tgl_pengajuan');
            $table->string('nm_pembimbing');
            $table->enum('bukti_ajuankp', ['punya', 'belum_punya']);
            $table->string('upfor_ajuan');
            $table->string('upper_pembimbing')->nullable();
            $table->enum('scanombuspbn', ['ada', 'tidak_ada']);
            $table->string('up_ombus');
            $table->string('up_pbn');
            $table->string('transkip');
            $table->string('pernyataan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuanpskkp');
    }
};
