<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    // 1. Data Master Bahan Pokok
    Schema::create('bahan_pokoks', function (Blueprint $table) {
        $table->id();
        $table->string('nama_bahan');
        $table->string('satuan'); 
        $table->string('kategori'); // Tambahan untuk Filter Layar 2
        $table->string('foto')->nullable();
        $table->decimal('harga_tertinggi', 12, 2);
        $table->string('daerah_tertinggi')->nullable(); // Tambahan untuk Detail Layar 3
        $table->decimal('harga_terendah', 12, 2);
        $table->string('daerah_terendah')->nullable(); // Tambahan untuk Detail Layar 3
        $table->timestamps();
    });

    // 2. Data Master Pasar
    Schema::create('pasars', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pasar');
        $table->string('wilayah'); // misal: Malang Kota, Malang Kabupaten
        $table->timestamps();
    });

    // 3. Data Harga (Transaksi & Tren)
    Schema::create('harga_harians', function (Blueprint $table) {
        $table->id();
        $table->foreignId('bahan_pokok_id')->constrained();
        $table->foreignId('pasar_id')->constrained();
        $table->decimal('harga_sekarang', 12, 2);
        $table->date('tanggal');
        $table->enum('tren', ['naik', 'turun', 'stabil']);
        $table->timestamps();
    });
}
};
