<?php

namespace Modules\Pariwisata\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PariwisataDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================================
        // 1. DATA DESTINASI WISATA
        // ============================================================
        DB::table('destinasi_wisatas')->insertOrIgnore([
            [
                'id' => 1,
                'nama_tempat' => 'Pemandian Air Panas Padusan',
                'deskripsi_sejarah' => 'Destinasi wisata alam yang terletak di lereng Gunung Welirang, terkenal sejak era kolonial sebagai tempat relaksasi dan pemulihan kesehatan berkat kandungan belerang alami pada airnya.',
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
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_tempat' => 'Gunung Bromo',
                'deskripsi_sejarah' => 'Gunung batuan aktif yang terletak di dalam kaldera Tengger. Terkenal secara internasional berkat hamparan lautan pasirnya yang luas serta pesona berburu matahari terbit (sunrise) yang magis.',
                'foto_utama' => 'bromo_main.jpg',
                'galeri_foto' => json_encode(['bromo1.jpg', 'bromo2.jpg']),
                'harga_tiket_masuk' => 29000.00,
                'rating' => 4.8,
                'kabupaten_kota' => 'Kabupaten Probolinggo',
                'kecamatan' => 'Sukapura',
                'ketinggian_mdpl' => 2329,
                'rata_rata_suhu' => 12.5,
                'ikon_cuaca_terkini' => 'sunny',
                'is_chse' => true,
                'is_sapta_pesona' => true,
                'sertifikat_kebersihan' => 'CHSE-2026-BROMO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama_tempat' => 'Air Terjun Coban Rondo',
                'deskripsi_sejarah' => 'Destinasi wisata air terjun ikonik di lereng pegunungan yang menyajikan aliran air jernih setinggi 84 meter. Lokasinya diselimuti hutan pinus asri yang sejuk dan memiliki wahana labirin buatan.',
                'foto_utama' => 'coban_rondo.jpg',
                'galeri_foto' => json_encode(['rondo1.jpg', 'rondo2.jpg']),
                'harga_tiket_masuk' => 35000.00,
                'rating' => 4.6,
                'kabupaten_kota' => 'Kabupaten Malang',
                'kecamatan' => 'Pujon',
                'ketinggian_mdpl' => 1135,
                'rata_rata_suhu' => 20.0,
                'ikon_cuaca_terkini' => 'rainy',
                'is_chse' => false,
                'is_sapta_pesona' => true,
                'sertifikat_kebersihan' => 'SP-2026-MALANG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ============================================================
        // 2. DATA AKOMODASI WISATA (Dikelompokkan per Kota/Destinasi)
        // ============================================================
        DB::table('akomodasi_wisatas')->insertOrIgnore([

            // ── MOJOKERTO (Sekitar Padusan) ──────────────────────────
            [
                'id' => 1,
                'nama_akomodasi' => 'Resort Grand Padusan',
                'foto_utama' => 'resort_padusan.jpg',
                'kabupaten_kota' => 'Kabupaten Mojokerto',
                'harga_sewa_terendah' => 350000.00,
                'deskripsi_fasilitas_utama' => 'Penginapan nyaman dengan fasilitas kolam air hangat pribadi dan pemandangan hutan pinus yang memukau.',
                'galeri_foto' => json_encode(['gp_room1.jpg', 'gp_room2.jpg']),
                'fasilitas_populer' => json_encode(['Kolam Air Hangat', 'Free Wi-Fi', 'Restoran', 'Parkir Luas']),
                'rating_total' => 4.7,
                'ulasan_tamu' => json_encode([
                    ['user' => 'Farid', 'komentar' => 'Tempatnya dingin, kolam hangatnya mantap!'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_akomodasi' => 'Bobocabin Padusan Pacet',
                'foto_utama' => 'bobocabin_padusan.jpg',
                'kabupaten_kota' => 'Kabupaten Mojokerto',
                'harga_sewa_terendah' => 650000.00,
                'deskripsi_fasilitas_utama' => 'Akomodasi kabin modern berbasis teknologi IoT tersembunyi di tengah hijaunya hutan pinus Padusan Pacet.',
                'galeri_foto' => json_encode(['bobo1.jpg', 'bobo2.jpg']),
                'fasilitas_populer' => json_encode(['Smart Window', 'Free Wi-Fi', 'Api Unggun', 'Hot Shower']),
                'rating_total' => 4.8,
                'ulasan_tamu' => json_encode([
                    ['user' => 'Reza', 'komentar' => 'Kabinnya canggih bener, suasananya tenang rill.'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama_akomodasi' => 'Pacet Mini Park Hotel',
                'foto_utama' => 'pacet_mini_park.jpg',
                'kabupaten_kota' => 'Kabupaten Mojokerto',
                'harga_sewa_terendah' => 280000.00,
                'deskripsi_fasilitas_utama' => 'Hotel keluarga dengan taman bermain anak dan kolam renang air hangat. Lokasi sangat strategis di pusat kawasan wisata Pacet.',
                'galeri_foto' => json_encode(['pmp1.jpg', 'pmp2.jpg']),
                'fasilitas_populer' => json_encode(['Kolam Renang', 'Taman Bermain', 'Free Wi-Fi', 'Restoran']),
                'rating_total' => 4.3,
                'ulasan_tamu' => json_encode([
                    ['user' => 'Siti', 'komentar' => 'Anak-anak senang banget main di kolamnya, harganya juga ramah.'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ── PROBOLINGGO (Sekitar Bromo) ──────────────────────────
            [
                'id' => 4,
                'nama_akomodasi' => 'Jiwa Jawa Resort Bromo',
                'foto_utama' => 'jiwajawa_bromo.jpg',
                'kabupaten_kota' => 'Kabupaten Probolinggo',
                'harga_sewa_terendah' => 1200000.00,
                'deskripsi_fasilitas_utama' => 'Resort premium yang menyuguhkan pemandangan eksotis pegunungan Tengger, galeri seni terbuka, dan restoran hangat berkonsep Jawa klasik.',
                'galeri_foto' => json_encode(['jj_room1.jpg', 'jj_room2.jpg']),
                'fasilitas_populer' => json_encode(['Pemanas Ruangan', 'Free Wi-Fi', 'Galeri Seni', 'Cafe & Restoran']),
                'rating_total' => 4.9,
                'ulasan_tamu' => json_encode([
                    ['user' => 'Budi', 'komentar' => 'View-nya juara dunia pas pagi hari, deket banget kalau mau ke Bromo.'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nama_akomodasi' => 'Cemara Indah Hotel Bromo',
                'foto_utama' => 'cemara_indah.jpg',
                'kabupaten_kota' => 'Kabupaten Probolinggo',
                'harga_sewa_terendah' => 450000.00,
                'deskripsi_fasilitas_utama' => 'Penginapan strategis yang berada tepat di bibir kaldera Tengger, memberikan pemandangan langsung ke kawah Bromo dari teras kamar.',
                'galeri_foto' => json_encode(['ci_room1.jpg', 'ci_room2.jpg']),
                'fasilitas_populer' => json_encode(['Hot Shower', 'Free Wi-Fi', 'Balkon View Bromo', 'Jeep Rental']),
                'rating_total' => 4.4,
                'ulasan_tamu' => json_encode([
                    ['user' => 'Nadia', 'komentar' => 'Kamarnya standar tapi view kawah Bromo dari teras luar biasa magis!'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'nama_akomodasi' => 'Lava View Lodge Bromo',
                'foto_utama' => 'lava_view.jpg',
                'kabupaten_kota' => 'Kabupaten Probolinggo',
                'harga_sewa_terendah' => 350000.00,
                'deskripsi_fasilitas_utama' => 'Lodge sederhana namun penuh pesona dengan posisi menghadap langsung ke Gunung Bromo dan lautan pasir Tengger.',
                'galeri_foto' => json_encode(['lv1.jpg', 'lv2.jpg']),
                'fasilitas_populer' => json_encode(['View Bromo', 'Hot Shower', 'Paket Sunrise Tour']),
                'rating_total' => 4.5,
                'ulasan_tamu' => json_encode([
                    ['user' => 'Dimas', 'komentar' => 'Sunrise dari sini epic banget, worth every penny!'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ── MALANG (Sekitar Coban Rondo) ─────────────────────────
            [
                'id' => 7,
                'nama_akomodasi' => 'Bobocabin Coban Rondo Malang',
                'foto_utama' => 'bobocabin_rondo.jpg',
                'kabupaten_kota' => 'Kabupaten Malang',
                'harga_sewa_terendah' => 700000.00,
                'deskripsi_fasilitas_utama' => 'Kabin pintar di dalam kawasan hutan Coban Rondo Pujon, memadukan kenyamanan hotel bintang lima dengan keasrian hutan pinus.',
                'galeri_foto' => json_encode(['bobo_rondo1.jpg', 'bobo_rondo2.jpg']),
                'fasilitas_populer' => json_encode(['Smart Window', 'Free Wi-Fi', 'Balkon Private', 'Hot Shower']),
                'rating_total' => 4.6,
                'ulasan_tamu' => json_encode([
                    ['user' => 'Farid', 'komentar' => 'Malam hari kabutnya tebal, dinginnya pas mantap.'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'nama_akomodasi' => 'Pujon Hill Manunggal Homestay',
                'foto_utama' => 'pujon_hill.jpg',
                'kabupaten_kota' => 'Kabupaten Malang',
                'harga_sewa_terendah' => 250000.00,
                'deskripsi_fasilitas_utama' => 'Homestay ramah kantong bernuansa rumah warga lokal yang sejuk, berlokasi sangat dekat dengan jalur wisata Air Terjun Coban Rondo.',
                'galeri_foto' => json_encode(['pujon1.jpg', 'pujon2.jpg']),
                'fasilitas_populer' => json_encode(['Free Wi-Fi', 'Dapur Bersama', 'Area Parkir']),
                'rating_total' => 4.2,
                'ulasan_tamu' => json_encode([
                    ['user' => 'Alex', 'komentar' => 'Cocok buat rombongan keluarga besar yang mau hemat ke Coban Rondo.'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'nama_akomodasi' => 'The Singhasari Resort Batu',
                'foto_utama' => 'singhasari_resort.jpg',
                'kabupaten_kota' => 'Kabupaten Malang',
                'harga_sewa_terendah' => 900000.00,
                'deskripsi_fasilitas_utama' => 'Resort bintang lima bergaya arsitektur Singhasari kuno, dilengkapi spa premium, kolam infinity, dan pemandangan pegunungan Malang yang spektakuler.',
                'galeri_foto' => json_encode(['sh1.jpg', 'sh2.jpg']),
                'fasilitas_populer' => json_encode(['Kolam Infinity', 'Spa', 'Free Wi-Fi', 'Fine Dining', 'Gym']),
                'rating_total' => 4.9,
                'ulasan_tamu' => json_encode([
                    ['user' => 'Linda', 'komentar' => 'Fasilitasnya lengkap, arsitekturnya keren banget berasa di zaman kerajaan.'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ============================================================
        // 3. DATA EVENT WISATA
        // ============================================================
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
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_event' => 'Banyuwangi Ethno Carnival (BEC) 2026',
                'deskripsi_acara' => 'Karnaval busana kontemporer berbasis budaya lokal yang megah, menampilkan ratusan talenta lokal di sepanjang jalan protokol Banyuwangi.',
                'poster_event' => 'poster_banyuwangi_ethno.jpg',
                'penyelenggara' => 'Dinas Kebudayaan dan Pariwisata Kabupaten Banyuwangi',
                'tanggal_mulai' => now()->addDays(15)->format('Y-m-d'),
                'tanggal_selesai' => now()->addDays(15)->format('Y-m-d'),
                'jam_operasional' => '10:00 - 17:00',
                'nama_tempat_lokasi' => 'Taman Blambangan',
                'kabupaten_kota' => 'Kabupaten Banyuwangi', 
                'koordinat_maps' => '-8.2114,114.3744',
                'is_berbayar' => false,
                'harga_tiket' => 0.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama_event' => 'Jazz Gunung Bromo 2026',
                'deskripsi_acara' => 'Pagelaran musik jazz bertaraf internasional yang diselenggarakan di amfiteater terbuka pada ketinggian 2.000 mdpl dengan latar pemandangan alam Bromo yang indah.',
                'poster_event' => 'poster_jazz_gunung_bromo.jpg',
                'penyelenggara' => 'Jagat Nusantara Ekspo',
                'tanggal_mulai' => now()->addDays(30)->format('Y-m-d'),
                'tanggal_selesai' => now()->addDays(32)->format('Y-m-d'),
                'jam_operasional' => '15:00 - 22:00',
                'nama_tempat_lokasi' => 'Amfiteater Jiwa Jawa Resort Bromo',
                'kabupaten_kota' => 'Kabupaten Probolinggo',
                'koordinat_maps' => '-7.9236,112.9524',
                'is_berbayar' => true,
                'harga_tiket' => 350000.00, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ============================================================
        // 4. DATA NASKAH KUNO
        // ============================================================
        DB::table('naskah_kunos')->insertOrIgnore([
            [
                'id' => 1,
                'judul' => 'Kitab Negarakertagama (Salinan Trowulan)',
                'deskripsi' => 'Kakawin Jawa Kuno yang menguraikan sejarah keagungan kerajaan Majapahit di masa pemerintahan Hayam Wuruk.',
                'jumlah_halaman' => 120,
                'foto_naskah' => 'negarakertagama.jpg',
                'kategori' => 'Sejarah/Sastra',
                'asal_daerah' => 'Mojokerto',
                'perkiraan_tahun' => '1365 Masehi',
                'jenis_aksara' => 'Kawi',
                'jenis_bahasa' => 'Jawa Kuno',
                'sumber_naskah' => 'Museum Trowulan',
                'skema_pendaftaran' => 'Registrasi Mandiri',
                'nama_pendaftar' => 'Tim Majadidi',
                'no_hp_pendaftar' => '08123456789',
                'alamat_pendaftar' => 'Klojen, Kota Malang',
                'file_lampiran_pdf' => 'naskah_negarakertagama.pdf',
                'status_pengajuan' => 'dikurasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}