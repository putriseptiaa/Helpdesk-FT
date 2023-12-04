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
        Schema::create('pengajuanpskta', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('nama');
            $table->string('nohp');
            $table->bigInteger('nim');
            $table->enum('jurusan', ['sipil', 'elektro', 'informatika', 'sistem_informasi']);
            $table->enum('jenis_surat', ['pskta']);
            $table->date('tgl_pengajuan');
            $table->string('nm_pembimbing1');
            $table->string('nm_pembimbing2');
            $table->string('ba_up');
            $table->date('created_date');
            $table->integer('current_wp')->nullable()->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuanpskta');
    }
};
