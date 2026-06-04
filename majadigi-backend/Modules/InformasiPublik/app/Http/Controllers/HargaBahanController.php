<?php

namespace Modules\InformasiPublik\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tetap diimport untuk hitungan AVG/Rata-rata grafik dan database
use Modules\InformasiPublik\app\Models\HargaHarian as ModelsHargaHarian;
// Import juga model BahanPokok agar bisa dicari detailnya langsung via Model
use Modules\InformasiPublik\app\Models\BahanPokok; 

class HargaBahanController extends Controller
{
    public function getHarga(Request $request) {
        // Logika mengambil harga harian beserta relasinya (Bawaan Temanmu)
        $data = ModelsHargaHarian::with(['bahanPokok', 'pasar'])
                ->where('tanggal', $request->tanggal ?? date('Y-m-d'))
                ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data Harga Bahan Pokok Berhasil Diambil',
            'data' => $data
        ]);
    }

    /**
     * Endpoint Detail Komoditas Siskaperbapo untuk Anak FE (Layar 3)
     * URL: GET /api/informasipublik/bahan-pokok/{id}
     */
    public function show($id)
    {
        // 1. Ambil data dasar komoditas (Bawang Merah/Putih) beserta metadata wilayah tertinggi & terendah
        // Menggunakan DB Builder agar langsung aman membaca kolom baru tanpa harus utak-atik file Model
        $bahan = DB::table('bahan_pokoks')->where('id', $id)->first();
        
        if (!$bahan) {
            return response()->json([
                'success' => false,
                'message' => 'Komoditas bahan pokok tidak ditemukan'
            ], 404);
        }

        // 2. Hitung harga rata-rata hari ini di seluruh Jatim (Muncul di highlight atas Layar 3)
        $rataRataHarga = ModelsHargaHarian::where('bahan_pokok_id', $id)
            ->where('tanggal', date('Y-m-d'))
            ->avg('harga_sekarang');

        // 3. Ambil List Harga per Kabupaten/Kota untuk list tabel bawah di Layar 3
        $hargaPerWilayah = ModelsHargaHarian::with('pasar')
            ->where('bahan_pokok_id', $id)
            ->where('tanggal', date('Y-m-d'))
            ->get()
            ->map(function($item) {
                return [
                    'kabupaten_kota' => $item->pasar->wilayah ?? 'Tidak Diketahui',
                    'harga_sekarang' => $item->harga_sekarang,
                    'tren' => $item->tren
                ];
            });

        // 4. Ambil data historis rata-rata 7 hari ke belakang khusus untuk render Line Chart Grafik Tren
        $grafikHistoris = ModelsHargaHarian::where('bahan_pokok_id', $id)
            ->select('tanggal', DB::raw('AVG(harga_sekarang) as rata_rata_harian'))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->take(7)
            ->get();

        // 5. Lempar JSON super matang siap lahap untuk FE Jetpack Compose / Figma
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Siskaperbapo Berhasil Diambil',
            'data' => [
                'id' => $bahan->id,
                'nama_bahan' => $bahan->nama_bahan,
                'kategori' => $bahan->kategori ?? 'Bumbu Dapur',
                'satuan' => $bahan->satuan,
                'harga_rata_rata_jatim' => round($rataRataHarga ?? 0, 2),
                'tren_umum' => 'turun', // Default simulasi sesuai figma turun rp50
                'metadata_harga' => [
                    'tertinggi' => [
                        'nominal' => $bahan->harga_tertinggi,
                        'wilayah' => $bahan->daerah_tertinggi ?? 'Kab. Pamekasan'
                    ],
                    'terendah' => [
                        'nominal' => $bahan->harga_terendah,
                        'wilayah' => $bahan->daerah_terendah ?? 'Kab. Nganjuk'
                    ]
                ],
                'list_harga_wilayah' => $hargaPerWilayah,
                'data_grafik_tren' => $grafikHistoris
            ]
        ], 200);
    }
}