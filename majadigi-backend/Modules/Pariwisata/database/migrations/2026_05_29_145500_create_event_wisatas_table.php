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
        Schema::create('event_wisatas', function (Blueprint $table) {
            $table->id();
            
            // 1. Data Master Event
            $table->string('nama_event');
            $table->text('deskripsi_acara');
            $table->string('poster_event')->nullable();
            $table->string('penyelenggara');
            
            // 2. Data Waktu Pelaksanaan
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('jam_operasional')->default('08:00 - selesai');
            
            // 3. Data Lokasi Event
            $table->string('nama_tempat_lokasi');
            $table->string('kabupaten_kota')->default('Kabupaten Mojokerto');
            $table->string('koordinat_maps')->nullable(); // Untuk pin point koordinat peta (lat, long)
            
            // 4. Data Status Tiket Masuk
            $table->boolean('is_berbayar')->default(false);
            $table->decimal('harga_tiket', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_wisatas');
    }
};