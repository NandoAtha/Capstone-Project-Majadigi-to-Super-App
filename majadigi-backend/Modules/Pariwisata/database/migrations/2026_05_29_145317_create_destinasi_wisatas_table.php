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
        Schema::create('destinasi_wisatas', function (Blueprint $table) {
            $table->id();
            
            // 1. Data Master Destinasi
            $table->string('nama_tempat');
            $table->text('deskripsi_sejarah');
            $table->string('foto_utama')->nullable();
            $table->json('galeri_foto')->nullable(); 
            $table->decimal('harga_tiket_masuk', 10, 2)->default(0);
            $table->decimal('rating', 2, 1)->default(0.0); 
            
            // 2. Data Filter Daerah
            $table->string('kabupaten_kota')->default('Kabupaten Mojokerto');
            $table->string('kecamatan')->nullable();
            
            // 3. Data Spesifikasi Cuaca & Geografis
            $table->integer('ketinggian_mdpl')->default(0);
            $table->decimal('rata_rata_suhu', 4, 1)->default(26.0); 
            $table->string('ikon_cuaca_terkini')->default('sunny');
            
            // 4. Data Sertifikasi Tempat Wisata
            $table->boolean('is_chse')->default(false); 
            $table->boolean('is_sapta_pesona')->default(false);
            $table->string('sertifikat_kebersihan')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasi_wisatas');
    }
};