<?php

namespace Modules\Pariwisata\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PariwisataDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Destinasi Wisata (Sesuai 100% dengan Migration)
        DB::table('destinasi_wisatas')->insertOrIgnore([
            [
                'id' => 1,
                'nama_tempat' => 'Pemandian Air Panas Padusan',
                'deskripsi_sejarah' => 'Destinasi wisata alam yang terletak di lereng Gunung Welirang, terkenal sejak era kolonial sebagai tempat relaksasi...',
                'foto_utama' => 'padusan_main.jpg',
                'galeri_foto' => json_encode(['padusan1.jpg', 'padusan2.jpg']),
                'harga_tiket_masuk' => 15000.00,
                'rating' => 4.5,
                'kabupaten_kota' => 'Kabupaten Mojokerto',
                'kecamatan' => 'Pacet',
                'ketinggian_mdpl' => 800,
                'rata_rata_suhu' => 22.0,
                'ikon_cuaca_terkini' => 'cloudy',
                'is_chse' => true,
                'is_sapta_pesona' => true,
                'sertifikat_kebersihan' => 'CHSE-2026-OK',
                'created_at' => now(), 
                'updated_at' => now()
            ]
        ]);

        // 2. Data Akomodasi (Sesuai Kolom: deskripsi_fasilitas_utama, galeri_foto, fasilitas_populer, ulasan_tamu)
        DB::table('akomodasi_wisatas')->insertOrIgnore([
            [
                'id' => 1,
                'nama_akomodasi' => 'Resort Grand Padusan',
                'foto_utama' => 'resort_padusan.jpg',
                'kabupaten_kota' => 'Kabupaten Mojokerto',
                'harga_sewa_terendah' => 350000.00,
                'deskripsi_fasilitas_utama' => 'Penginapan nyaman dengan fasilitas kolam air hangat pribadi dan pemandangan pinus.',
                'galeri_foto' => json_encode(['room1.jpg', 'room2.jpg']),
                'fasilitas_populer' => json_encode(['Kolam Air Hangat', 'Free Wi-Fi', 'Restoran']),
                'rating_total' => 4.7,
                'ulasan_tamu' => json_encode([['user' => 'Farid', 'komentar' => 'Tempatnya dingin, kolam hangatnya mantap!']]),
                'created_at' => now(), 
                'updated_at' => now()
            ]
        ]);

        // 3. Data Event Wisata (Sesuai Kolom: deskripsi_acara, penyelenggara, tanggal_selesai, nama_tempat_lokasi)
        DB::table('event_wisatas')->insertOrIgnore([
            [
                'id' => 1,
                'nama_event' => 'Festival Budaya Bumi Majapahit 2026',
                'deskripsi_acara' => 'Pagelaran seni tari kolosal, pameran keris kuno, dan pawai budaya memperingati kejayaan kerajaan Majapahit.',
                'poster_event' => 'poster_festival_majapahit.jpg',
                'penyelenggara' => 'Dinas Kebudayaan dan Pariwisata',
                'tanggal_mulai' => now()->addDays(7)->format('Y-m-d'),
                'tanggal_selesai' => now()->addDays(9)->format('Y-m-d'),
                'jam_operasional' => '08:00 - selesai',
                'nama_tempat_lokasi' => 'Lapangan Utama Trowulan',
                'kabupaten_kota' => 'Kabupaten Mojokerto',
                'koordinat_maps' => '-7.5605,112.3789',
                'is_berbayar' => false,
                'harga_tiket' => 0.00,
                'created_at' => now(), 
                'updated_at' => now()
            ]
        ]);

        // 4. Data Naskah Kuno (Fix Typo: asal_daerah & Sesuaikan default status_pengajuan)
        DB::table('naskah_kunos')->insertOrIgnore([
            [
                'id' => 1,
                'judul' => 'Kitab Negarakertagama (Salinan Trowulan)',
                'deskripsi' => 'Kakawin Jawa Kuno yang menguraikan sejarah keagungan kerajaan Majapahit di masa pemerintahan Hayam Wuruk.',
                'jumlah_halaman' => 120,
                'foto_naskah' => 'negarakertagama.jpg',
                'kategori' => 'Sejarah/Sastra',
                'asal_daerah' => 'Mojokerto', // Kolom fix dari asal_derah ke asal_daerah
                'perkiraan_tahun' => '1365 Masehi',
                'jenis_aksara' => 'Kawi',
                'jenis_bahasa' => 'Jawa Kuno',
                'sumber_naskah' => 'Museum Trowulan',
                'skema_pendaftaran' => 'Registrasi Mandiri',
                'nama_pendaftar' => 'Tim Majadidi',
                'no_hp_pendaftar' => '08123456789',
                'alamat_pendaftar' => 'Klojen, Kota Malang',
                'file_lampiran_pdf' => 'naskah_negarakertagama.pdf',
                'status_pengajuan' => 'dikurasi', // Default bawaan database
                'created_at' => now(), 
                'updated_at' => now()
            ]
        ]);
    }
}