<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
// ✅ WAJIB INI
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // REGISTER
    // public function register(Request $request)
    // {
    //     //return response()->json(['message' => 'Versi kode terbaru!']);
    //     try {
    //         $request->validate([
    //             'name' => 'required|string|max:255',
    //             'email' => 'required|email|unique:users,email',
    //             'phone' => 'required|string|max:20',
    //             'address' => 'required|string',
    //             'nik' => 'required|string|unique:users,nik',
    //             'birth_date' => 'required|date',
    //             'password' => 'required|min:6|confirmed',
    //         ]);

    //         $tanggal_mysql = Carbon::parse($request->birth_date)->format('Y-m-d');
            
    //         $user = User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'phone' => $request->phone,
    //             'address' => $request->address,
    //             'nik' => $request->nik,
    //             'birth_date' => $tanggal_mysql,
    //             'password' => Hash::make($request->password),
    //         ]);

    //         $token = $user->createToken('auth_token')->plainTextToken;

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Register berhasil',
    //             'token' => $token,
    //             'user' => $user,
    //         ], 201);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Akun Sudah Terdaftar atau Data Tidak Valid',
    //             'error_asli' => $e->getMessage(),
    //             'baris' => $e->getLine(),
    //             'file' => $e->getFile()
    //         ], 500);
    //     }
    // }

    public function register(Request $request)
    {
        try {
            // Validasi input dengan format tanggal yang ketat (YYYY-MM-DD)
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|max:20',
                'address' => 'required|string',
                'nik' => 'required|string|unique:users,nik',
                'birth_date' => 'required|date_format:Y-m-d', 
                'password' => 'required|min:6|confirmed',
            ]);

            // Mengonversi tanggal ke format database tanpa parsing otomatis
            $tanggal_mysql = Carbon::createFromFormat('Y-m-d', $request->birth_date)->format('Y-m-d');
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'nik' => $request->nik,
                'birth_date' => $tanggal_mysql,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Register berhasil',
                'token' => $token,
                'user' => $user,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Menampilkan error validasi agar kamu tahu field mana yang salah
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan server',
                'error_asli' => $e->getMessage(),
            ], 500);
        }
    }

    // LOGIN
    public function login(Request $request)
    {
        // DEBUG DULU (biar pasti masuk)
       // return response()->json($request->all());

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $user
        ]);
    }

    // ME
    public function me(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => $request->user()
        ]);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout berhasil'
        ]);
    }
}