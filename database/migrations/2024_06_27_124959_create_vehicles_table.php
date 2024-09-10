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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('merk', 30);
            $table->string('warna', 30);
            $table->integer('kapasitas');
            $table->string('nomor_polisi', 10);
            $table->enum('full_ac', ['Tersedia', 'Tidak tersedia']);
            $table->enum('musik', ['Tersedia', 'Tidak tersedia']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
