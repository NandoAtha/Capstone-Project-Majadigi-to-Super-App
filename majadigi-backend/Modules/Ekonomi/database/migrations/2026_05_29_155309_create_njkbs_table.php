<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('njkbs', function (Blueprint $table) {
            $table->id();

            // 5. Data Input Filter Pencarian (Dropdown)
            $table->string('jenis_kendaraan'); // Sepeda Motor, Mobil Penumpang, dll
            $table->string('merk_kendaraan');  // Honda, Yamaha, Toyota
            $table->integer('tahun_pembuatan');
            $table->string('model_tipe_spesifik'); // Vario 160 CBS, Avanza Veloz 1.5

            // 6. Data Hasil Pencarian Identitas & Tarif Pajak Berdasarkan Kepemilikan
            $table->integer('cc_kendaraan');
            $table->decimal('nilai_jual', 12, 2); // Nilai dasar sebelum dipajak
            
            // Tarif Persentase Pajak (Plat Hitam, Merah, Kuning, BBN)
            $table->decimal('tarif_plat_hitam_persen', 4, 2)->default(1.5);
            $table->decimal('tarif_plat_hitam_progresif_persen', 4, 2)->default(2.0);
            $table->decimal('tarif_plat_merah_persen', 4, 2)->default(0.5);
            $table->decimal('tarif_plat_kuning_persen', 4, 2)->default(1.0);
            $table->decimal('tarif_bbn_1_persen', 4, 2)->default(10.0); // Bea Balik Nama Pertama
            $table->decimal('tarif_bbn_2_persen', 4, 2)->default(1.0);  // Bea Balik Nama Kedua

            // 7. Data Penerimaan Negara Bukan Pajak (PNBP) Standar Polri
            $table->decimal('pnbp_penerbitan_bpkb', 12, 2);
            $table->decimal('pnbp_penerbitan_stnk', 12, 2);
            $table->decimal('pnbp_penerbitan_tnkb', 12, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('njkbs');
    }
};