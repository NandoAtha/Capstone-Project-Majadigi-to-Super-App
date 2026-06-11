<?php
namespace Modules\InformasiPublik\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InformasiPublik\Models\HoaxReport as ModelsHoaxReport;

class HoaxController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'deskripsi_laporan' => 'required',
        ]);

        // Logika Nomor Tiket: KH-JAM-RANDOM (Contoh: KH-2359-ABC1)
        $tiket = 'KH-' . date('Hi') . '-' . strtoupper(bin2hex(random_bytes(2)));

        $report = ModelsHoaxReport::create([
            'nomor_tiket' => $tiket,
            'nama_pelapor' => $request->nama_pelapor ?? 'Anonim',
            'deskripsi_laporan' => $request->deskripsi_laporan,
            'url_bukti' => $request->url_bukti,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan Klinik Hoax berhasil diterima',
            'data' => $report
        ], 201);
    }
}