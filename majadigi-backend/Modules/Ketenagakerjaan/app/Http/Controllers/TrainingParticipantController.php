<?php

namespace Modules\Ketenagakerjaan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ketenagakerjaan\app\Models\TrainingParticipant;
use Modules\Ketenagakerjaan\app\Models\JobSeeker;

class TrainingParticipantController extends Controller
{
    // POST daftar pelatihan
    public function join(Request $request)
    {
        $request->validate([
            'training_id' => 'required|exists:trainings,id',
        ]);

        $user = auth()->user();

        $jobSeeker = JobSeeker::where('user_id', $user->id)->first();

        if (!$jobSeeker) {
            return response()->json([
                'success' => false,
                'message' => 'Profil pelamar belum dibuat'
            ], 400);
        }

        $exist = TrainingParticipant::where([
            'job_seeker_id' => $jobSeeker->id,
            'training_id' => $request->training_id
        ])->first();

        if ($exist) {
            return response()->json([
                'success' => false,
                'message' => 'Sudah terdaftar'
            ], 400);
        }

        $data = TrainingParticipant::create([
            'job_seeker_id' => $jobSeeker->id,
            'training_id' => $request->training_id,
            'status' => 'terdaftar',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil daftar pelatihan',
            'data' => $data
        ]);
    }

    // GET pelatihan saya
    public function myTrainings()
    {
        $user = auth()->user();

        $jobSeeker = JobSeeker::where('user_id', $user->id)->first();

        $data = TrainingParticipant::with('training')
            ->where('job_seeker_id', $jobSeeker->id)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}