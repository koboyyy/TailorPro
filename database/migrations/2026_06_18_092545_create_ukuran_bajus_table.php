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
        Schema::create('ukuran_bajus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->onDelete('cascade');
            $table->integer('l_badan')->nullable();
            $table->integer('l_pinggang')->nullable();
            $table->integer('l_punggung')->nullable();
            $table->integer('p_bahu')->nullable();
            $table->integer('p_lengan')->nullable();
            $table->integer('l_lengan')->nullable();
            $table->integer('t_susu')->nullable();
            $table->integer('t_pinggang')->nullable();
            $table->integer('l_pinggul')->nullable();
            $table->integer('p_baju')->nullable();
            $table->string('p_rok')->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ukuran_bajus');
    }
};
