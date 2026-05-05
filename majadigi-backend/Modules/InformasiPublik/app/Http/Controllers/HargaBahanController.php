<?php

namespace Modules\InformasiPublik\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InformasiPublik\app\Models\HargaHarian as ModelsHargaHarian;


class HargaBahanController extends Controller
{
    public function getHarga(Request $request) {
    // Logika mengambil harga harian beserta relasinya
    $data = ModelsHargaHarian::with(['bahanPokok', 'pasar'])
            ->where('tanggal', $request->tanggal ?? date('Y-m-d'))
            ->get();

    return response()->json([
        'success' => true,
        'message' => 'Data Harga Bahan Pokok Berhasil Diambil',
        'data' => $data
    ]);
}
}
