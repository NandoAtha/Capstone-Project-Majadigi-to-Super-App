<?php
namespace Modules\InformasiPublik\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InformasiPublik\Models\HoaxReport;

class HoaxController extends Controller
{
    public function index(Request $request)
    {
        $reports = HoaxReport::orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar laporan Klinik Hoaks berhasil diambil!',
            'data' => $reports
        ], 200);
    }

    public function show($id)
    {
        $report = HoaxReport::find($id);
        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan hoaks tidak ditemukan!'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Detail laporan hoaks berhasil ditemukan!',
            'data' => $report
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate(['deskripsi_laporan' => 'required']);
        $tiket = 'KH-' . date('Hi') . '-' . strtoupper(bin2hex(random_bytes(2)));
        $report = HoaxReport::create([
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

    public function summary()
    {
        return response()->json([
            'berita_hoaks' => HoaxReport::where('status', 'hoax')->count(),
            'disinformasi' => HoaxReport::where('status', 'disinformasi')->count(),
            'fakta' => HoaxReport::where('status', 'valid')->count(),
            'hate_speech' => HoaxReport::where('status', 'hate_speech')->count(),
        ], 200);
    }
    public function track($tiket)
    {
        $report = HoaxReport::where('nomor_tiket', $tiket)->first();

        if (!$report) {
            return response()->json(['success' => false, 'message' => 'Tiket tidak ditemukan!'], 404);
        }

        return response()->json(['success' => true, 'data' => $report], 200);
    }
}