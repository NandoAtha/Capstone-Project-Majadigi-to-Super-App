<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\CoreController;

// 1. PINDAHKAN LOGIN KE SINI (DI LUAR MIDDLEWARE)
Route::post('v1/login', function (Request $request) {
    // Validasi sederhana
    $user = User::where('email', $request->email)->first();

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
    // Rute lain yang butuh login taruh di bawah sini
});
