<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            
            // 1. Data Input Pencarian
            $table->string('nomor_polisi')->unique(); // Contoh: L 1234 AB
            $table->string('nomor_rangka_lima_digit'); // 5 digit terakhir

            // 2. Data Identitas Kendaraan Hasil Pencarian
            $table->boolean('is_aktif')->default(true);
            $table->string('warna_kendaraan');
            $table->string('model_kendaraan'); // Sepeda Motor, Mobil Penumpang, dll
            $table->string('tipe_kendaraan');  // X1B02N04L0
            $table->integer('tahun_pembuatan');
            $table->date('tanggal_jatuh_tempo_pajak');
            $table->date('tanggal_jatuh_tempo_stnk'); // Untuk deteksi masa berlaku 5 tahunan

            // 3. Data Rincian Biaya Pajak Tahunan
            $table->decimal('pkb_dasar', 12, 2);
            $table->decimal('pkb_progresif', 12, 2)->default(0);
            $table->decimal('opsen_pkb', 12, 2)->default(0);
            $table->decimal('swdkllj', 12, 2)->default(35000); // Standar motor Jatim
            $table->decimal('parkir_berlangganan', 12, 2)->default(25000); // Khas Jatim
            $table->decimal('biaya_pengesahan_stnk', 12, 2)->default(25000);
            $table->decimal('total_denda', 12, 2)->default(0);

            // 4. Data Rincian Biaya 5 Tahunan
            $table->decimal('biaya_cetak_stnk', 12, 2)->default(0);
            $table->decimal('biaya_cetak_tnkb', 12, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};