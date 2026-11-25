<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('outlets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_outlet', 20)->unique();
            $table->string('nama_outlet', 100);
            $table->text('alamat');
            $table->string('kota', 50);
            $table->string('no_telepon', 20);
            $table->string('email', 100);
            $table->string('nama_manager', 100);
            $table->time('jam_buka');
            $table->time('jam_tutup');
            $table->integer('kapasitas_kursi');
            $table->enum('status', ['buka', 'tutup'])->default('buka');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outlets');
    }
};
