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
        // Add l_dada and l_ketiak to ukuran_bajus table
        Schema::table('ukuran_bajus', function (Blueprint $table) {
            $table->integer('l_dada')->nullable()->after('l_lengan');
            $table->integer('l_ketiak')->nullable()->after('p_baju');
        });

        // Add l_dada and l_ketiak to pesanans table
        Schema::table('pesanans', function (Blueprint $table) {
            $table->integer('l_dada')->nullable()->after('l_lengan');
            $table->integer('l_ketiak')->nullable()->after('p_baju');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ukuran_bajus', function (Blueprint $table) {
            $table->dropColumn(['l_dada', 'l_ketiak']);
        });

        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn(['l_dada', 'l_ketiak']);
        });
    }
};
