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
        Schema::create('naskah_kunos', function (Blueprint $table) {
            $table->id();
            
            // 1. Data Master Naskah
            $table->string('judul');
            $table->text('deskripsi');
            $table->integer('jumlah_halaman');
            $table->string('foto_naskah')->nullable();

            // 2. Data Kategori Naskah
            // Masa Pra Islam, Primbon & Mantra, Era Keagamaan, Serat, Babad, dll
            $table->string('kategori'); 

            // 3. Data Metadata Naskah
            $table->string('asal_daerah');
            $table->string('perkiraan_tahun'); // contoh: "Abad 14" atau "1345"
            $table->string('jenis_aksara');
            $table->string('jenis_bahasa');

            // 4. Data Asal-usul / Sumber
            $table->string('sumber_naskah'); // Nama pemilik atau instansi

            // 5. Data Pendaftaran / Skema (Pengalihan Kepemilikan, Penitipan, Registrasi)
            $table->string('skema_pendaftaran')->nullable();
            $table->string('nama_pendaftar')->nullable();
            $table->string('no_hp_pendaftar')->nullable();
            $table->text('alamat_pendaftar')->nullable();
            $table->string('file_lampiran_pdf')->nullable(); // File PDF naskah jika ada
            $table->string('status_pengajuan')->default('dikurasi'); // dikurasi, diterima, ditolak

            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naskah_kunos');
    }
};
