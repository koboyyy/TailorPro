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
        Schema::create('pola_busanas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->onDelete('cascade');
            $table->string('name');
            $table->string('type');
            $table->date('date_created');
            $table->string('status')->default('Aktif');
            
            // Sizes snapshot
            $table->integer('l_dada')->nullable();
            $table->integer('p_baju')->nullable();
            $table->integer('l_bahu')->nullable();
            $table->integer('p_lengan')->nullable();
            $table->integer('l_pinggang')->nullable();
            $table->integer('l_pinggul')->nullable();
            $table->integer('p_celana')->nullable();
            $table->string('p_rok')->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pola_busanas');
    }
};
