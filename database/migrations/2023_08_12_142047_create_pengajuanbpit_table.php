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
        Schema::create('pengajuanbpit', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tgi_lahir');
            $table->bigInteger('nim');
            $table->string('no_ijazah');
            $table->enum('jurusan', ['sipil', 'elektro', 'informatika', 'sistem_informasi']);
            $table->date('tgl_lulus');
            $table->date('tgl_terbitijazah');
            $table->string('nohp');
            $table->string('email');
            $table->string('alamat');
            $table->string('nm_pengambil');
            $table->string('nobuku_pengambilan');
            $table->string('foto_pengambilan');
            $table->enum('kerja', ['sudah', 'belum']);
            $table->string('jabatan')->nullable();
            $table->string('nm_perusahaan')->nullable();
            $table->string('alamat_perusahaan')->nullable();
            $table->enum('jenis_pernjanjiankerja', ['pns', 'pppk', 'k_tetap', 'k_honorer', 'k_paruhwaktu', 'per_individu', 'per_firma', 'per_cv', 'per_pt', 'lainnya',])->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->enum('gaji', ['gaji1', 'gaji2', 'gaji3', 'gaji4'])->nullable();
            $table->string('email_perusahaan')->nullable();
            $table->string('notelp_perusahaan')->nullable();
            $table->string('pernyataan')->nullable();
            $table->enum('keterangan', ['bersedia', 'tidak_bersedia']);
            $table->string('alasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuanbpit');
    }
};
