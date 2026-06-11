<?php

namespace Modules\InformasiPublik\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\InformasiPublik\Models\HargaHarian;

class HargaBahanController extends Controller
{
    public function getHarga()
    {
        $data = HargaHarian::with(['bahanPokok', 'pasar'])
            ->where('tanggal', request('tanggal') ?? now()->format('Y-m-d'))
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data Harga Bahan Pokok Berhasil Diambil',
            'data' => $data,
        ]);
    }

    public function detail($id)
    {
        $data = HargaHarian::with(['bahanPokok', 'pasar'])
            ->find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail harga berhasil diambil',
            'data' => $data,
        ]);
    }
}