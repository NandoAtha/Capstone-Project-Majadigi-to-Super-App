<?php

namespace Modules\Pariwisata\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Pariwisata\Models\AkomodasiWisata;

class AkomodasiWisataController extends Controller
{
    /**
     * 1. Layanan Eksplorasi Akomodasi / Hotel & Resort (GET)
     */
    public function index(Request $request)
    {
        $query = AkomodasiWisata::query();

        // Cari berdasarkan nama properti/hotel
        if ($request->has('search')) {
            $query->where('nama_akomodasi', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan wilayah kabupaten/kota di Jatim
        if ($request->has('kabupaten_kota')) {
            $query->where('kabupaten_kota', $request->kabupaten_kota);
        }

        $akomodasi = $query->paginate($request->get('per_page', 10));

        return response()->json([
            'success' => true,
            'message' => 'Data akomodasi penginapan berhasil diambil',
            'meta' => [
                'current_page' => $akomodasi->currentPage(),
                'last_page' => $akomodasi->lastPage(),
                'total_results' => $akomodasi->total()
            ],
            'data' => $akomodasi->items()
        ], 200);
    }

    /**
     * 2. Layanan Pendaftaran Properti Akomodasi Baru (POST)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_akomodasi' => 'required|string|max:255',
            'kabupaten_kota' => 'required|string',
            'harga_sewa_terendah' => 'required|numeric',
            'deskripsi_fasilitas_utama' => 'required|string',
            'fasilitas_populer' => 'required|array', // Harus dikirim berupa array, misal: ["Wi-Fi", "Pool"]
        ]);

        // Isi data simulasi bawaan untuk foto dan ulasan tamu terdahulu
        $validated['foto_utama'] = 'default-hotel.jpg';
        $validated['galeri_foto'] = ['room1.jpg', 'room2.jpg'];
        $validated['rating_total'] = 4.8;
        $validated['ulasan_tamu'] = [
            [
                'nama_pengguna' => 'Farid Ramdhani',
                'avatar' => 'avatar1.jpg',
                'teks_ulasan' => 'Tempatnya sejuk banget, dekat dengan lokasi wisata sejarah Trowulan. Fasilitas lengkap!',
                'tanggal' => now()->toDateString()
            ]
        ];

        $akomodasi = AkomodasiWisata::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Properti akomodasi baru berhasil didaftarkan!',
            'data' => $akomodasi
        ], 201);
    }
}