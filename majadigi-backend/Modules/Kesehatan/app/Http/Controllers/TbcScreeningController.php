<?php

namespace Modules\Kesehatan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use Modules\Kesehatan\Models\TbcScreening;
use Modules\Kesehatan\Models\TbcAnswer;
use Modules\Kesehatan\Models\TbcScreeningSymptom;

class TbcScreeningController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // =========================
            // VALIDASI
            // =========================
            $request->validate([
                'pelapor_nama'     => 'required|string',
                'pelapor_kelompok' => 'nullable|string',
                'pelapor_instansi' => 'nullable|string',
                'pelapor_no_telp'  => 'nullable|string',

                'symptoms'           => 'required|array',
                'symptoms.*.id'      => 'required|exists:tbc_symptoms,id',
                'symptoms.*.answer'  => 'required|in:ya,tidak',

                'answers'                => 'required|array',
                'answers.*.question_id'  => 'required|exists:tbc_questions,id',
                'answers.*.answer'       => 'required|in:ya,tidak',
            ]);

            // =========================
            // HITUNG SKOR
            // =========================
            $yesSymptoms = collect($request->symptoms)
                ->where('answer', 'ya')
                ->count();

            $yesAnswers = collect($request->answers)
                ->where('answer', 'ya')
                ->count();

            $score = $yesSymptoms + $yesAnswers;

            if ($score >= 5) {
                $risk = 'tinggi';
            } elseif ($score >= 3) {
                $risk = 'sedang';
            } else {
                $risk = 'rendah';
            }

            // =========================
            // SIMPAN SCREENING
            // =========================
            $screening = TbcScreening::create([
                'user_id'          => auth()->id(),
                'pelapor_nama'     => $request->pelapor_nama,
                'pelapor_kelompok' => $request->pelapor_kelompok,
                'pelapor_instansi' => $request->pelapor_instansi,
                'pelapor_no_telp'  => $request->pelapor_no_telp,
                'status_risiko'    => $risk,
            ]);

            // =========================
            // SIMPAN GEJALA
            // =========================
            foreach ($request->symptoms as $symptom) {
                TbcScreeningSymptom::create([
                    'screening_id' => $screening->id,
                    'symptom_id'   => $symptom['id'],
                    'answer'       => $symptom['answer'], // ya / tidak
                ]);
            }

            // =========================
            // SIMPAN JAWABAN
            // =========================
            foreach ($request->answers as $answer) {
                TbcAnswer::create([
                    'screening_id' => $screening->id,
                    'question_id'  => $answer['question_id'],
                    'answer'       => $answer['answer'], // ya / tidak
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Screening berhasil disimpan',
                'data' => [
                    'id'            => $screening->id,
                    'status_risiko' => $risk,
                    'score'         => $score
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function questions()
    {
        $questions = \Modules\Kesehatan\Models\TbcQuestion::all();

        return response()->json([
            'success' => true,
            'data'    => $questions
        ]);
    }

    public function symptoms()
    {
        $symptoms = \Modules\Kesehatan\Models\TbcSymptom::all();

        return response()->json([
            'success' => true,
            'data'    => $symptoms
        ]);
    }
}