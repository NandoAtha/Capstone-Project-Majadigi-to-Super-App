<?php

namespace Modules\Ketenagakerjaan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ketenagakerjaan\app\Models\TrainingParticipant;
use Modules\Ketenagakerjaan\app\Models\JobSeeker;
use Modules\Ketenagakerjaan\app\Enums\TrainingParticipantStatus;

class TrainingParticipantController extends Controller
{
    /**
     * JOIN TRAINING
     */
    public function join(Request $request)
    {
        $request->validate([
            'training_id' => 'required|exists:trainings,id',
            'nama'        => 'required|string|max:255',
            'nik'         => 'required|string|max:20',
            'no_telp'     => 'required|string|max:20',
        ]);

        $user = auth()->user();

        $jobSeeker = JobSeeker::firstOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'nama' => $request->nama,
                'nik' => $request->nik,
                'no_telp' => $request->no_telp,
            ]
        );

        $participant = TrainingParticipant::firstOrCreate(
            [
                'job_seeker_id' => $jobSeeker->id,
                'training_id' => $request->training_id,
            ],
            [
                'status' => TrainingParticipantStatus::REGISTERED,
            ]
        );

        if (!$participant->wasRecentlyCreated) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah terdaftar pada pelatihan ini'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil daftar pelatihan',
            'data' => $participant
        ]);
    }

    /**
     * GET MY TRAININGS
     */
    public function myTrainings()
    {
        $user = auth()->user();

        $jobSeeker = JobSeeker::where('user_id', $user->id)->first();

        if (!$jobSeeker) {
            return response()->json([
                'success' => false,
                'message' => 'Profil pelamar belum dibuat'
            ], 400);
        }

        $data = TrainingParticipant::with(['training', 'training.center'])
            ->where('job_seeker_id', $jobSeeker->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $user = auth()->user();

        $jobSeeker = JobSeeker::where('user_id', $user->id)->first();

        if (!$jobSeeker) {
            return response()->json([
                'success' => false,
                'message' => 'Profil pelamar belum dibuat'
            ], 404);
        }

        $participant = TrainingParticipant::with([
            'training',
            'training.center',
            'jobSeeker',
        ])
            ->where('job_seeker_id', $jobSeeker->id)
            ->where('id', $id)
            ->first();

        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $participant
        ]);
    }

}