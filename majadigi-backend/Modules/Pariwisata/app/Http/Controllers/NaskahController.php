<?php

namespace Modules\Pariwisata\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Pariwisata\Models\NaskahKuno; // Mengarah ke model yang sudah diperbaiki

class NaskahController extends Controller
{
    // 1. Fungsi Eksplorasi (Landing, Pencarian, & Paginasi)
    public function index(Request $request)
    {
        $query = NaskahKuno::query();

        // Fitur Pencarian Berdasarkan Judul/Keyword
        if ($request->has('keyword')) {
            $query->where('judul', 'like', '%' . $request->keyword . '%');
        }

        // Fitur Filter Dropdown (Kategori, Daerah, Aksara, Bahasa)
        if ($request->has('kategori')) $query->where('kategori', $request->kategori);
        if ($request->has('asal_daerah')) $query->where('asal_daerah', $request->asal_daerah);
        if ($request->has('jenis_aksara')) $query->where('jenis_aksara', $request->jenis_aksara);
        if ($request->has('jenis_bahasa')) $query->where('jenis_bahasa', $request->jenis_bahasa);

        // Paginasi Otomatis (Default: 10 data per halaman)
        $naskah = $query->paginate($request->per_page ?? 10);

        return response()->json([
            'success' => true,
            'message' => 'Data naskah kuno berhasil diambil',
            'meta' => [
                'current_page' => $naskah->currentPage(),
                'last_page' => $naskah->lastPage(),
                'total_results' => $naskah->total()
            ],
            'data' => $naskah->items()
        ], 200);
    }

    // 2. Fungsi Pendaftaran Naskah Baru (POST)
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'nama_pendaftar' => 'required|string',
            'skema_pendaftaran' => 'required|string', // Pengalihan, Penitipan, Registrasi
        ]);

        $naskah = NaskahKuno::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi ?? '-',
            'jumlah_halaman' => $request->jumlah_halaman ?? 0,
            'kategori' => $request->kategori ?? 'Umum',
            'asal_daerah' => $request->asal_daerah ?? 'Jawa Timur',
            'perkiraan_tahun' => $request->perkiraan_tahun ?? 'Tidak Diketahui',
            'jenis_aksara' => $request->jenis_aksara ?? 'Jawa',
            'jenis_bahasa' => $request->jenis_bahasa ?? 'Jawa Kuno',
            'sumber_naskah' => $request->sumber_naskah ?? $request->nama_pendaftar,
            'skema_pendaftaran' => $request->skema_pendaftaran,
            'nama_pendaftar' => $request->nama_pendaftar,
            'no_hp_pendaftar' => $request->no_hp_pendaftar,
            'alamat_pendaftar' => $request->alamat_pendaftar,
            'status_pengajuan' => 'dikurasi' // Otomatis masuk status kurasi awal
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Naskah kuno berhasil didaftarkan ke sistem Majadigi!',
            'data' => $naskah
        ], 201);
    }
    // 3. Fungsi Detail Naskah Berdasarkan ID (GET)
    public function show($id)
    {
        $naskah = NaskahKuno::find($id);

        if (!$naskah) {
            return response()->json([
                'success' => false,
                'message' => 'Naskah kuno tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail naskah kuno berhasil diambil',
            'data' => $naskah
        ], 200);
    }

    // 4. Fungsi Kirim Komentar Naskah (POST)
    // Catatan: Untuk sementara kita simpan logikanya di sini, nanti relasi tabel komentar bisa dikembangkan saat tabel User Super App sudah matang.
    public function storeKomentar(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required|string',
        ]);

        $naskah = NaskahKuno::find($id);

        if (!$naskah) {
            return response()->json([
                'success' => false,
                'message' => 'Naskah kuno tidak ditemukan'
            ], 404);
        }

        // Response simulasi sukses menyimpan komentar sesuai kebutuhan tiket/ID komentar
        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dikirim!',
            'data' => [
                'tiket_id' => uniqid('TCK-'),
                'naskah_id' => $naskah->id,
                'user' => $request->user()->name ?? 'Pengguna Majadigi',
                'komentar' => $request->komentar,
                'created_at' => now()
            ]
        ], 201);
    }
}