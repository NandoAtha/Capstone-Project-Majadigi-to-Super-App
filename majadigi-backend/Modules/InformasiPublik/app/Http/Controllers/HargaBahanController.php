<?php

namespace Modules\InformasiPublik\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\InformasiPublik\Models\HargaHarian;

class HargaBahanController extends Controller
{
    public function getHarga()
{
    try {

        $data = HargaHarian::with([
            'bahanPokok',
            'pasar'
        ])->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);

    } catch (\Throwable $e) {

        return response()->json([
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
        ], 500);
    }
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