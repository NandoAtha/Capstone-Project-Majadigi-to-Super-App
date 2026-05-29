<?php

namespace Modules\Darurat\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Darurat\app\Models\NomorDarurat;

class NomorDaruratController extends Controller
{
   
    public function index(Request $request)
    {
        $query = NomorDarurat::query();

        if ($request->filled('tingkat_wilayah')) {
            $query->where('tingkat_wilayah', $request->tingkat_wilayah);
        }

        if ($request->filled('nama_wilayah')) {
            $query->where('nama_wilayah', 'like', '%' . $request->nama_wilayah . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $data = $query->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Nomor Darurat berhasil diambil',
            'data'    => $data
        ], 200);
    }
}