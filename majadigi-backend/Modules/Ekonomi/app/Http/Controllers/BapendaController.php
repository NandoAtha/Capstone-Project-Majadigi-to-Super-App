<?php

namespace Modules\Ekonomi\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Ekonomi\app\Models\Kendaraan;
use Modules\Ekonomi\app\Models\Njkb;

class BapendaController extends Controller
{
    /**
     * 1. Layanan Informasi Pajak Kendaraan Bermotor (PKB) - POST (Pencarian & Hitung Pajak)
     */
    public function cekPajak(Request $request)
    {
        // Validasi input wajib: Plat nomor dan 5 digit nomor rangka
        $request->validate([
            'nomor_polisi' => 'required|string',
            'nomor_rangka_lima_digit' => 'required|string|size:5',
        ]);

        // Cari data kendaraan di database
        $kendaraan = Kendaraan::where('nomor_polisi', $request->nomor_polisi)
            ->where('nomor_rangka_lima_digit', $request->nomor_rangka_lima_digit)
            ->first();

        if (!$kendaraan) {
            return response()->json([
                'success' => false,
                'message' => 'Data kendaraan tidak ditemukan! Pastikan Nopol dan 5 digit Nomor Rangka sudah sesuai.'
            ], 404);
        }

        // LOGIKA KALKULATOR: Hitung total biaya tahunan secara otomatis
        $total_tahunan = $kendaraan->pkb_dasar + 
                         $kendaraan->pkb_progresif + 
                         $kendaraan->swdkllj + 
                         $kendaraan->parkir_berlangganan + 
                         $kendaraan->biaya_pengesahan_stnk + 
                         $kendaraan->total_denda;

        return response()->json([
            'success' => true,
            'message' => 'Data informasi pajak kendaraan berhasil ditemukan',
            'data' => [
                'identitas' => [
                    'nomor_polisi' => $kendaraan->nomor_polisi,
                    'status_keaktifan' => $kendaraan->is_aktif ? 'Aktif' : 'Mati',
                    'warna' => $kendaraan->warna_kendaraan,
                    'model' => $kendaraan->model_kendaraan,
                    'tipe' => $kendaraan->tipe_kendaraan,
                    'tahun_pembuatan' => $kendaraan->tahun_pembuatan,
                    'jatuh_tempo_pajak' => $kendaraan->tanggal_jatuh_tempo_pajak->toDateString(),
                ],
                'rincian_tahunan' => [
                    'pkb_dasar' => $kendaraan->pkb_dasar,
                    'pkb_progresif' => $kendaraan->pkb_progresif,
                    'swdkllj' => $kendaraan->swdkllj,
                    'parkir_berlangganan' => $kendaraan->parkir_berlangganan,
                    'biaya_pengesahan_stnk' => $kendaraan->biaya_pengesahan_stnk,
                    'total_denda' => $kendaraan->total_denda,
                    'total_keseluruhan_tahunan' => $total_tahunan
                ],
                'rincian_lima_tahunan' => [
                    'biaya_cetak_stnk_baru' => $kendaraan->biaya_cetak_stnk,
                    'biaya_cetak_tnkb_baru' => $kendaraan->biaya_cetak_tnkb,
                ],
                'keamanan_alert' => $kendaraan->status_stnk_alert // Memanggil Accessor dinamis dari Model
            ]
        ], 200);
    }

    /**
     * 2. Layanan Info Nilai Jual Kendaraan Bermotor (NJKB) - GET (Eksplorasi & Filter Dropdown)
     */
    public function cekNjkb(Request $request)
    {
        $query = Njkb::query();

        // Penerapan filter dropdown dinamis dari mobile
        if ($request->has('jenis_kendaraan')) {
            $query->where('jenis_kendaraan', $request->jenis_kendaraan);
        }
        if ($request->has('merk_kendaraan')) {
            $query->where('merk_kendaraan', $request->merk_kendaraan);
        }
        if ($request->has('tahun_pembuatan')) {
            $query->where('tahun_pembuatan', $request->tahun_pembuatan);
        }
        if ($request->has('model_tipe_spesifik')) {
            $query->where('model_tipe_spesifik', 'like', '%' . $request->model_tipe_spesifik . '%');
        }

        $njkbResults = $query->get();

        // Mapping output agar menyajikan rincian tarif persentase & PNBP secara rapi
        $dataMapped = $njkbResults->map(function ($item) {
            return [
                'spesifikasi' => [
                    'model' => $item->jenis_kendaraan,
                    'merk' => $item->merk_kendaraan,
                    'tipe_spesifik' => $item->model_tipe_spesifik,
                    'cc' => $item->cc_kendaraan,
                    'tahun_dibuat' => $item->tahun_pembuatan,
                    'nilai_jual_dasar' => $item->nilai_jual
                ],
                'tarif_pajak_kepemilikan' => [
                    'plat_hitam_pribadi' => $item->tarif_plat_hitam_persen . '%',
                    'plat_hitam_progresif' => $item->tarif_plat_hitam_progresif_persen . '%',
                    'plat_merah_dinas' => $item->tarif_plat_merah_persen . '%',
                    'plat_kuning_umum' => $item->tarif_plat_kuning_persen . '%',
                    'bbn_1' => $item->tarif_bbn_1_persen . '%',
                    'bbn_2' => $item->tarif_bbn_2_persen . '%',
                ],
                'pnbp_polri' => [
                    'penerbitan_bpkb' => $item->pnbp_penerbitan_bpkb,
                    'penerbitan_stnk' => $item->pnbp_penerbitan_stnk,
                    'penerbitan_tnkb_plat' => $item->pnbp_penerbitan_tnkb,
                ]
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Data master NJKB berhasil ditarik',
            'count' => $dataMapped->count(),
            'data' => $dataMapped
        ], 200);
    }
}