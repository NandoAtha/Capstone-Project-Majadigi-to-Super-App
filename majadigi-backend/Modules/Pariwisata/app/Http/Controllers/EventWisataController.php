<?php

namespace Modules\Pariwisata\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Pariwisata\app\Models\EventWisata;

class EventWisataController extends Controller
{
    /**
     * 1. Layanan Kalender Wisata / Menampilkan Seluruh Event (GET)
     */
    public function index(Request $request)
    {
        $query = EventWisata::query();

        // Cari berdasarkan keyword nama event
        if ($request->has('search')) {
            $query->where('nama_event', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan wilayah kabupaten/kota
        if ($request->has('kabupaten_kota')) {
            $query->where('kabupaten_kota', $request->kabupaten_kota);
        }

        // Urutkan berdasarkan tanggal mulai terdekat
        $query->orderBy('tanggal_mulai', 'asc');

        $events = $query->paginate($request->get('per_page', 10));

        return response()->json([
            'success' => true,
            'message' => 'Data kalender event wisata berhasil diambil',
            'meta' => [
                'current_page' => $events->currentPage(),
                'last_page' => $events->lastPage(),
                'total_results' => $events->total()
            ],
            'data' => $events->items()
        ], 200);
    }

    /**
     * 2. Layanan Pendaftaran Event Baru (POST)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_event' => 'required|string|max:255',
            'deskripsi_acara' => 'required|string',
            'penyelenggara' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'jam_operasional' => 'nullable|string',
            'nama_tempat_lokasi' => 'required|string',
            'kabupaten_kota' => 'required|string',
            'koordinat_maps' => 'nullable|string',
            'is_berbayar' => 'required|boolean',
            'harga_tiket' => 'required_if:is_berbayar,true|numeric'
        ]);

        // Simulasi poster default jika tidak upload foto
        $validated['poster_event'] = 'default-event.jpg';

        $event = EventWisata::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Event/Festival baru berhasil didaftarkan ke kalender wisata!',
            'data' => $event
        ], 201);
    }
}