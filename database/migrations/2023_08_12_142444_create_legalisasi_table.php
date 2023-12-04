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
        Schema::create('legalisasi', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('nama');
            $table->bigInteger('nim');
            $table->string('jurusan');
            $table->string('nohp');
            $table->enum('jenisdok', ['ijazah', 'transkip']);
            $table->string('file_asli');
            $table->string('file_fotocopy');
            $table->string('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legalisasi');
    }
};
