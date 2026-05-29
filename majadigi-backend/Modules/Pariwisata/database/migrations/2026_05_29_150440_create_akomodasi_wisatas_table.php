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
        Schema::create('akomodasi_wisatas', function (Blueprint $table) {
            $table->id();
            
            // 1. Data Master Properti Akomodasi
            $table->string('nama_akomodasi'); // Contoh: Grand Whiz Hotel Trawulan
            $table->string('foto_utama')->nullable();
            $table->string('kabupaten_kota')->default('Kabupaten Mojokerto');
            $table->decimal('harga_sewa_terendah', 12, 2)->default(0);
            $table->text('deskripsi_fasilitas_utama');
            
            // 2. Galeri Foto Kamar & Fasilitas (Menyimpan banyak foto dalam bentuk array JSON)
            $table->json('galeri_foto')->nullable();
            
            // 3. Fasilitas Populer (Kolam renang, Wi-Fi, Restoran, Pemandangan Gunung, dll)
            $table->json('fasilitas_populer')->nullable();
            
            // 4. Ulasan & Rating Total Akomodasi
            $table->decimal('rating_total', 2, 1)->default(0.0); // Contoh: 4.7
            $table->json('ulasan_tamu')->nullable(); // Menyimpan data komentar tamu terdahulu

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akomodasi_wisatas');
    }
};