<?php

namespace Modules\InformasiPublik\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiPublikDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Master Pasar (Sesuai kolom: id, nama_pasar, wilayah)
        DB::table('pasars')->insertOrIgnore([
            ['id' => 1, 'nama_pasar' => 'Pasar Kolpajung', 'wilayah' => 'Kab. Pamekasan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_pasar' => 'Pasar Besar Madiun', 'wilayah' => 'Kota Madiun', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama_pasar' => 'Pasar Tambahrejo', 'wilayah' => 'Kota Surabaya', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nama_pasar' => 'Pasar Anjuk Ladang', 'wilayah' => 'Kab. Nganjuk', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 2. Data Master Bahan Pokok (Sesuai kolom: id, nama_bahan, satuan, harga_tertinggi, harga_terendah)
        DB::table('bahan_pokoks')->insertOrIgnore([
            [
                'id' => 1, 
                'nama_bahan' => 'Bawang Merah', 
                'satuan' => 'kg', 
                'kategori' => 'Bumbu Dapur', // Sesuai Filter FE
                'foto' => 'bawang_merah.png',
                'harga_tertinggi' => 45000.00, 
                'daerah_tertinggi' => 'Kab. Pamekasan', // Ditampilkan di Layar 3
                'harga_terendah' => 26000.00, 
                'daerah_terendah' => 'Kab. Nganjuk',   // Ditampilkan di Layar 3
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 2, 
                'nama_bahan' => 'Bawang Putih', 
                'satuan' => 'kg', 
                'kategori' => 'Bumbu Dapur',
                'foto' => 'bawang_putih.png',
                'harga_tertinggi' => 36000.00, 
                'daerah_tertinggi' => 'Kota Surabaya',
                'harga_terendah' => 32000.00, 
                'daerah_terendah' => 'Kota Madiun',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 3, 
                'nama_bahan' => 'Beras Premium', 
                'satuan' => 'kg', 
                'kategori' => 'Sembako', // Sesuai Filter FE
                'foto' => 'beras_premium.png',
                'harga_tertinggi' => 16500.00, 
                'daerah_tertinggi' => 'Kota Surabaya',
                'harga_terendah' => 14800.00, 
                'daerah_terendah' => 'Kab. Nganjuk',
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);

        // 3. Data Harga Harian (Sesuai kolom: bahan_pokok_id, pasar_id, harga_sekarang, tanggal, tren)
        DB::table('harga_harians')->insertOrIgnore([
            ['bahan_pokok_id' => 1, 'pasar_id' => 1, 'harga_sekarang' => 45000.00, 'tanggal' => now()->format('Y-m-d'), 'tren' => 'naik', 'created_at' => now(), 'updated_at' => now()],
            ['bahan_pokok_id' => 1, 'pasar_id' => 2, 'harga_sekarang' => 42666.00, 'tanggal' => now()->format('Y-m-d'), 'tren' => 'naik', 'created_at' => now(), 'updated_at' => now()],
            ['bahan_pokok_id' => 1, 'pasar_id' => 3, 'harga_sekarang' => 36200.00, 'tanggal' => now()->format('Y-m-d'), 'tren' => 'stabil', 'created_at' => now(), 'updated_at' => now()],
            ['bahan_pokok_id' => 1, 'pasar_id' => 4, 'harga_sekarang' => 26000.00, 'tanggal' => now()->format('Y-m-d'), 'tren' => 'turun', 'created_at' => now(), 'updated_at' => now()],

            // Data Kemarin-kemarin (Buat penunjang Grafik Tren Baris Chart Anak FE)
            ['bahan_pokok_id' => 1, 'pasar_id' => 3, 'harga_sekarang' => 35000.00, 'tanggal' => now()->subDays(1)->format('Y-m-d'), 'tren' => 'naik', 'created_at' => now(), 'updated_at' => now()],
            ['bahan_pokok_id' => 1, 'pasar_id' => 3, 'harga_sekarang' => 34000.00, 'tanggal' => now()->subDays(2)->format('Y-m-d'), 'tren' => 'naik', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 4. Data Laporan Hoax
        DB::table('hoax_reports')->insertOrIgnore([
            [
                'nomor_tiket' => 'TKT-20260602-001',
                'nama_pelapor' => 'Muhammad Farid',
                'deskripsi_laporan' => 'Beredar pesan berantai di WhatsApp bahwa Alun-Alun Malang ditutup total selama sebulan penuh mulai besok pagi karena ada kunjungan kenegaraan.',
                'url_bukti' => 'https://jabar.id/bukti/hoax1.jpg',
                'status' => 'hoax', // proses, valid, hoax
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'nomor_tiket' => 'TKT-20260602-002',
                'nama_pelapor' => 'Anonim',
                'deskripsi_laporan' => 'Ada link pendaftaran bansos kuota internet gratis 100GB mengatasnamakan Diskominfo Jatim dengan mengisi data KTP dan KK.',
                'url_bukti' => 'https://jabar.id/bukti/hoax2.jpg',
                'status' => 'valid', // di-set valid artinya ini laporan yang terbukti bermuatan hoax
                'created_at' => now(), 
                'updated_at' => now()
            ]
        ]);
        // 5. DATA NOMOR DARURAT (Tambahkan ini, sesuaikan nama kolomnya jika ada yang beda)
        DB::table('nomor_darurat')->insertOrIgnore([
            [
                'id' => 1,
                'tingkat_wilayah' => 'Kota',
                'nama_wilayah' => 'Kota Malang',
                'nama_layanan' => 'Pemadam Kebakaran (Damkar)',
                'nomor_telepon' => '(0341) 362222',
                'kategori' => 'Keamanan & Penyelamatan',
                'keterangan' => 'Layanan darurat pemadaman kebakaran dan penyelamatan penyelamatan wilayah Kota Malang.',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 2,
                'tingkat_wilayah' => 'Provinsi',
                'nama_wilayah' => 'Jawa Timur',
                'nama_layanan' => 'Ambulans Gawat Darurat (AGD)',
                'nomor_telepon' => '118',
                'kategori' => 'Kesehatan',
                'keterangan' => 'Layanan panggilan ambulans gawat darurat medis.',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 3,
                'tingkat_wilayah' => 'Kota',
                'nama_wilayah' => 'Kota Malang',
                'nama_layanan' => 'Polresta Malang Kota',
                'nomor_telepon' => '(0341) 366444',
                'kategori' => 'Keamanan & Penyelamatan',
                'keterangan' => 'Layanan pengaduan tindakan kriminalitas dan ketertiban masyarakat.',
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);
    }
}