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
        Schema::table('pengajuanskp', function (Blueprint $table) {
            $table->bigInteger('id_user')->unsigned()->index()->nullable()->after('current_wp');
            $table->foreign('id_user')->references(coloum:'id')->on(table:'users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuanskp', function (Blueprint $table) {
            $table->dropColumn('id_user');
            
        });
    }
};
