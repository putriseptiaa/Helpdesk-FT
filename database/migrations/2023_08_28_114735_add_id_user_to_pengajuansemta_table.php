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
        Schema::table('pengajuansemta', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->index()->nullable()->after('current_wp');
            $table->foreign('user_id')->references(coloum:'id')->on(table:'users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuansemta', function (Blueprint $table) {
            $table->dropColumn('user_id');
            
        });
    }
};
