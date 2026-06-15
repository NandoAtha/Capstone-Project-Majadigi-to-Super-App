<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash; // <-- WAJIB DITAMBAHKAN
use App\Models\User; // <-- WAJIB DITAMBAHKAN (Sesuaikan namespace Model User-mu jika di dalam module)
use Modules\Core\Http\Controllers\CoreController;

// 1. PINDAHKAN LOGIN KE SINI (DI LUAR MIDDLEWARE)
Route::post('v1/login', function (Request $request) {
    // Validasi input data dari Flutter
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Cari user berdasarkan email
    $user = User::where('email', $request->email)->first();

    // Cek kecocokan password menggunakan Hash::check
    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Email atau Password salah'], 401);
    }

    // Buat token Sanctum
    $token = $user->createToken('token-majadigi')->plainTextToken;

    return response()->json([
        'message' => 'Login Sukses!',
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
});

// 2. RUTE YANG BUTUH TOKEN (DI DALAM MIDDLEWARE)
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('cores', CoreController::class)->names('core');
    
    // Tempat rute Modul Wisata, Naskah Kuno, & Islamic Centre yang butuh login [cite: The user is a member of "Tim Majadidi," currently working on a Capstone Project to develop a modular Super App that utilizes dynamic feature loading and API-ready architecture. Evidence: Ongoing technical collaboration and troubleshooting related to the project's backend and modular design. Conversation Date: 2026-04 to 2026-05.]
});