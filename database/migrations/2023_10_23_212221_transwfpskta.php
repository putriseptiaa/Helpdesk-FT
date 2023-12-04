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
        Schema::create('transwfpskta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuanpskta_id');
            $table->foreign('pengajuanpskta_id')->references(coloum:'id')->on(table:'pengajuanpskta');
            $table->bigInteger('wfreference')->unsigned()->index()->nullable()->default('1');
            $table->foreign('wfreference')->references(coloum:'id')->on(table:'wfreference')->onDelete('cascade');
            $table->bigInteger('approved_by')->unsigned()->index()->nullable();
            $table->foreign('approved_by')->references(coloum:'id')->on(table:'users')->onDelete('cascade');
            // $table->unsignedBigInteger('wfreference');
            // $table->foreign('wfreference')->references(coloum:'id')->on(table:'wfreference');
            // $table->unsignedBigInteger('approved_by');
            // $table->foreign('approved_by')->references(coloum:'id')->on(table:'users');
            $table->text('history');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transwfpskta');
    }
};
