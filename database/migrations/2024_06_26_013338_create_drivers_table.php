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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('no_id_card', 30)->unique();
            $table->string('nik', 16)->unique();
            $table->string('nama', 50);
            $table->text('alamat');
            $table->date('tanggal_lahir');
            $table->integer('umur');
            $table->string('agama', 50);
            $table->string('status_kawin', 50);
            $table->string('jenis_sim', 20);
            $table->string('no_telepon', 15);
            $table->string('photo_profile')->default('default.png')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
