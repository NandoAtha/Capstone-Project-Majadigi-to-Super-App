<?php

namespace Modules\Ekonomi\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Ekonomi\app\Models\Kendaraan;
use Modules\Ekonomi\app\Models\Njkb;

class BapendaSimulasiSeeder extends Seeder
{
    public function run(): void
    {
        // 1. DATA SIMULASI KENDARAAN
        Kendaraan::updateOrCreate(
            ['nomor_polisi' => 'N 1234 FAR'],
            [
                'nomor_rangka_lima_digit' => '89123',
                'is_aktif' => true,
                'warna_kendaraan' => 'Hitam Glossy',
                'model_kendaraan' => 'Sepeda Motor',
                'tipe_kendaraan' => 'H5C02R20S1 M/T',
                'tahun_pembuatan' => 2024,
                'tanggal_jatuh_tempo_pajak' => '2027-03-15',
                'tanggal_jatuh_tempo_stnk' => '2029-03-15',
                'pkb_dasar' => 245000,
                'pkb_progresif' => 0,
                'swdkllj' => 35000,
                'parkir_berlangganan' => 25000,
                'biaya_pengesahan_stnk' => 25000,
                'total_denda' => 0,
                'biaya_cetak_stnk' => 0,
                'biaya_cetak_tnkb' => 0,
            ]
        );

        Kendaraan::updateOrCreate(
            ['nomor_polisi' => 'L 9999 RAM'],
            [
                'nomor_rangka_lima_digit' => '54321',
                'is_aktif' => false,
                'warna_kendaraan' => 'Putih Mutiara',
                'model_kendaraan' => 'Mobil Penumpang',
                'tipe_kendaraan' => 'Avanza Veloz 1.5 Q CVT',
                'tahun_pembuatan' => 2021,
                'tanggal_jatuh_tempo_pajak' => '2026-01-10',
                'tanggal_jatuh_tempo_stnk' => '2026-01-10',
                'pkb_dasar' => 3100000,
                'pkb_progresif' => 620000,
                'swdkllj' => 143000,
                'parkir_berlangganan' => 50000,
                'biaya_pengesahan_stnk' => 50000,
                'total_denda' => 120000,
                'biaya_cetak_stnk' => 200000,
                'biaya_cetak_tnkb' => 100000,
            ]
        );

        // 2. DATA MASTER NJKB
        Njkb::updateOrCreate(
            ['model_tipe_spesifik' => 'Vario 160 CBS'],
            [
                'jenis_kendaraan' => 'Sepeda Motor',
                'merk_kendaraan' => 'Honda',
                'tahun_pembuatan' => 2024,
                'cc_kendaraan' => 160,
                'nilai_jual' => 19800000,
                'tarif_plat_hitam_persen' => 1.5,
                'tarif_plat_hitam_progresif_persen' => 2.0,
                'tarif_plat_merah_persen' => 0.5,
                'tarif_plat_kuning_persen' => 1.0,
                'tarif_bbn_1_persen' => 10.0,
                'tarif_bbn_2_persen' => 1.0,
                'pnbp_penerbitan_bpkb' => 225000,
                'pnbp_penerbitan_stnk' => 100000,
                'pnbp_penerbitan_tnkb' => 60000,
            ]
        );
    }
}