<?php

namespace Modules\Ekonomi\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Ekonomi\Models\Kendaraan;
use Modules\Ekonomi\Models\Njkb;

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

        // LOGIKA KALKULATOR BAPENDA: Tambahkan variabel $kendaraan->opsen_pkb ke dalam total hitungan harian
        $total_tahunan = $kendaraan->pkb_dasar + 
                         $kendaraan->pkb_progresif + 
                         ($kendaraan->opsen_pkb ?? 0) + // 👈 OPSEN PKB MASUK KE HITUNGAN TOTAL
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
                    // Diubah ke parsing Carbon aman jika field db berbentuk string
                    'jatuh_tempo_pajak' => Carbon::parse($kendaraan->tanggal_jatuh_tempo_pajak)->toDateString(),
                ],
                'rincian_tahunan' => [
                    'opsen_pkb' => $kendaraan->opsen_pkb,
                    'pkb_dasar' => $kendaraan->pkb_dasar,
                    'pkb_progresif' => $kendaraan->pkb_progresif,
                    'opsen_pkb' => $kendaraan->opsen_pkb ?? 0, // 👈 MENYEMBUR KE JSON DETAIL LAYAR 3 FE
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
                'keamanan_alert' => $kendaraan->status_stnk_alert ?? 'Aman'
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
        if ($request->filled('jenis_kendaraan')) {
            $query->where('jenis_kendaraan', $request->jenis_kendaraan);
        }

        if ($request->filled('merk_kendaraan')) {
            $query->where('merk_kendaraan', $request->merk_kendaraan);
        }

        if ($request->filled('tahun_pembuatan')) {
            $query->where('tahun_pembuatan', $request->tahun_pembuatan);
        }

        if ($request->filled('model_tipe_spesifik')) {
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

    public function dropdownNjkb()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'jenis_kendaraan' => Njkb::select('jenis_kendaraan')
                    ->distinct()
                    ->pluck('jenis_kendaraan'),

                'merk_kendaraan' => Njkb::select('merk_kendaraan')
                    ->distinct()
                    ->pluck('merk_kendaraan'),

                'tahun_pembuatan' => Njkb::select('tahun_pembuatan')
                    ->distinct()
                    ->orderByDesc('tahun_pembuatan')
                    ->pluck('tahun_pembuatan'),

                'model_tipe_spesifik' => Njkb::select('model_tipe_spesifik')
                    ->distinct()
                    ->pluck('model_tipe_spesifik'),
            ]
        ]);
    }

}