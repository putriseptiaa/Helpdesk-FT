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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->string('judul_berita');
            $table->text('detail_berita');
            $table->date('tanggal_post');
            
            $table->unsignedBigInteger('created_by')->nullable();
            //$table->foreign('created_by')->references(coloum:'id')->on(table:'users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
