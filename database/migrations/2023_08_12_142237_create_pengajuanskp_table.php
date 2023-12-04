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
        Schema::create('pengajuanskp', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('nama');
            $table->string('nohp');
            $table->bigInteger('nim');
            $table->enum('jurusan', ['sipil', 'elektro', 'informatika', 'sistem_informasi']);
            $table->date('tgl_pengajuan');
            $table->string('nm_pembimbing');
            $table->enum('forper_kp', ['punya', 'belum_punya']);
            $table->string('upfor_ajuan')->nullable();
            $table->string('upper_pembimbing')->nullable();
            $table->string('surat_selesaikp');
            $table->string('daftarhadirkp');
            $table->string('nilaikp_pembimbing');
            $table->string('sk_pembimbingkp');
            $table->string('lembar_pembimbingkp');
            $table->string('transkip');
            $table->string('draft_lapkp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuanskp');
    }
};
