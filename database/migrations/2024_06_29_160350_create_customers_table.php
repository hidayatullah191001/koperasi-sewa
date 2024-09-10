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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nik', 16);
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Pria', 'Wanita']);
            $table->integer('umur');
            $table->text('alamat');
            $table->string('photo_ktp');
            $table->string('no_telephone', 13);
            $table->foreignId('kota_asal');
            $table->foreignId('kota_tujuan');
            $table->integer('harga_tiket');
            $table->integer('harga_bagasi')->nullable();
            $table->string('keterangan_bagasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
