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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_transaksi');
            $table->string('pembayaran');
            $table->date('tanggal_pemberangkatan');
            $table->foreignId('driver_id');
            $table->foreignId('vehicle_id');
            $table->foreignId('customer_id');
            $table->foreignId('kota_asal_id');
            $table->foreignId('kota_tujuan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
