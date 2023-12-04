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
        Schema::create('pengajuansemta', function (Blueprint $table) {
                $table->id();
                $table->string('email');
                $table->string('nama');
                $table->string('nohp');
                $table->bigInteger('nim');
                $table->enum('jurusan', ['sipil', 'elektro', 'informatika', 'sistem_informasi']);
                $table->date('tgl_pengajuan');
                $table->string('nm_pembimbing1');
                $table->string('nm_pembimbing2');
                $table->enum('upper_seminar', ['punya', 'belum_punya']);
                $table->string('for_seminar')->nullable();
                $table->string('upper_pembimbing1')->nullable();
                $table->string('upper_pembimbing2')->nullable();
                $table->string('sk_pembimbingta');
                $table->string('lembar_pembimbingta');
                $table->string('transkip');
                $table->string('bukti_penyerahan_lapkp');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuansemta');
    }
};
