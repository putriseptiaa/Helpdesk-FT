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
        Schema::create('pengajuanpptakp', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('nama');
            $table->string('nohp');
            $table->bigInteger('nim');
            $table->enum('jurusan', ['sipil', 'elektro', 'informatika', 'sistem_informasi']);
            $table->string('permohonan_dok');
            $table->string('skpembimbing_akhir');
            $table->string('uppernyataan_perspem');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuanpptakp');
    }
};
