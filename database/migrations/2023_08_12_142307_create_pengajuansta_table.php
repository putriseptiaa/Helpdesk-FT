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
        Schema::create('pengajuansta', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('nama');
            $table->string('nohp');
            $table->bigInteger('nim'); 
            $table->enum('jurusan', ['sipil', 'elektro', 'informatika', 'sistem_informasi']);
            $table->date('tgl_pengajuan');
            $table->string('nm_pembimbing1');
            $table->string('nm_pembimbing2');
            $table->enum('uppersta', ['punya', 'belum_punya']);
            $table->string('for_ta')->nullable();
            $table->string('upper_pembimbing1')->nullable();
            $table->string('upper_pembimbing2')->nullable();
            $table->string('sk_pembimbingta');
            $table->string('transkip');
            $table->string('buksum_artikel');
            $table->string('lembar_revisi_seminar');
            $table->string('draft_ta');
            $table->string('bukbayar_ukt');
            $table->string('tes_telp');
            $table->string('cek_plagiat');
            $table->enum('kerja', ['sudah', 'belum']);
            $table->string('jabatan')->nullable();
            $table->string('nm_perusahaan')->nullable();
            $table->string('alamat_perusahaan')->nullable();
            $table->enum('jenis_perjanjiankerja', ['pns', 'pppk', 'k_tetap', 'k_honorer', 'k_paruhwaktu', 'per_individu', 'per_firma', 'per_cv', 'per_pt', 'lainnya',])->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->enum('gaji', ['gaji1', 'gaji2', 'gaji3', 'gaji4'])->nullable();
            $table->string('email_perusahaan')->nullable();
            $table->string('notelp_perusahaan')->nullable();
            $table->enum('pernyataan', ['benar', 'tidak_benar'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuansta');
    }
};
