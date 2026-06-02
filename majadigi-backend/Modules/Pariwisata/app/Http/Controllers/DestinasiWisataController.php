<?php

namespace Modules\Pariwisata\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Pariwisata\app\Models\DestinasiWisata;

class DestinasiWisataController extends Controller
{
    /**
     * 1. Layanan Destinasi Wisata (Landing, Pencarian, & Filter Daerah)
     */
    public function index(Request $request)
    {
        $query = DestinasiWisata::query();

        // Filter berdasarkan keyword nama tempat wisata
        if ($request->has('search')) {
            $query->where('nama_tempat', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kabupaten/kota di Jawa Timur
        if ($request->has('kabupaten_kota')) {
            $query->where('kabupaten_kota', $request->kabupaten_kota);
        }

        // Ambil data dengan paginasi (default 10 data per halaman)
        $destinasi = $query->paginate($request->get('per_page', 10));

        return response()->json([
            'success' => true,
            'message' => 'Data destinasi wisata berhasil diambil',
            'meta' => [
                'current_page' => $destinasi->currentPage(),
                'last_page' => $destinasi->lastPage(),
                'total_results' => $destinasi->total()
            ],
            'data' => $destinasi->items()
        ], 200);
    }

    /**
     * 2. Layanan Tambah/Pendaftaran Destinasi Wisata Baru
     */
    public function store(Request $request)
    {
        // Validasi data input sesuai dokumen kebutuhan data
        $validated = $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'deskripsi_sejarah' => 'required|string',
            'harga_tiket_masuk' => 'required|numeric',
            'kabupaten_kota' => 'required|string',
            'kecamatan' => 'nullable|string',
            'ketinggian_mdpl' => 'nullable|integer',
            'rata_rata_suhu' => 'nullable|numeric',
            'ikon_cuaca_terkini' => 'nullable|string',
            'is_chse' => 'nullable|boolean',
            'is_sapta_pesona' => 'nullable|boolean',
        ]);

        // Simulasi pengisian default nilai jika kosong
        $validated['rating'] = 5.0; // Tempat wisata baru otomatis dapet rating default
        $validated['foto_utama'] = 'default-wisata.jpg';
        $validated['galeri_foto'] = ['default-wisata.jpg'];

        $destinasi = DestinasiWisata::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Destinasi wisata baru berhasil didaftarkan!',
            'data' => $destinasi
        ], 201);
    }
}