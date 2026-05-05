<?php

namespace Modules\Ketenagakerjaan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ketenagakerjaan\app\Models\JobApplication;
use Modules\Ketenagakerjaan\app\Models\JobSeeker;

class JobApplicationController extends Controller
{
    // POST /api/sinaker/apply
    public function apply(Request $request)
    {
        $request->validate([
            'job_training_id' => 'required|exists:jobs_training,id',
        ]);

        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak login'
            ], 401);
        }

        $jobSeeker = JobSeeker::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nama' => $request->nama,
                'nik' => $request->nik,
                'no_telp' => $request->no_telp,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
            ]
        );

        if (!$jobSeeker) {
            return response()->json([
                'success' => false,
                'message' => 'Profil pelamar belum dibuat'
            ], 400);
        }

        $application = JobApplication::create([
            'job_seeker_id' => $jobSeeker->id,
            'job_training_id' => $request->input('job_training_id'),
            'status' => 'pendaftaran',
            'tanggal_daftar' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil melamar pekerjaan',
            'data' => $application
        ]);
    }

    // GET /api/sinaker/my-applications
    public function myApplications()
    {
        $user = auth()->user();

        $jobSeeker = JobSeeker::where('user_id', $user->id)->first();

        $data = JobApplication::with('jobs_training')
            ->where('job_seeker_id', $jobSeeker->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}