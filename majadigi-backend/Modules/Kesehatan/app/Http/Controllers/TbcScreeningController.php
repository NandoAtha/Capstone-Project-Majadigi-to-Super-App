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
                'pelapor_nik'      => 'nullable|string',
                'bantu_lapor_nama' => 'nullable|string',
                'bantu_lapor_nik'  => 'nullable|string',

                'umur'          => 'nullable|integer',
                'alamat'        => 'nullable|string',
                'pekerjaan'     => 'nullable|string',
                'kabupaten'     => 'nullable|string',
                'kecamatan'     => 'nullable|string',
                'kelurahan'     => 'nullable|string',
                'berat_badan'   => 'nullable|numeric',
                'tinggi_badan'  => 'nullable|numeric',

                'symptoms'           => 'nullable|array',
                'symptoms.*.id'      => 'nullable|exists:tbc_symptoms,id',
                'symptoms.*.answer'  => 'nullable|in:ya,tidak',

                'answers'                => 'nullable|array',
                'answers.*.question_id'  => 'nullable|exists:tbc_questions,id',
                'answers.*.answer'       => 'nullable|in:ya,tidak',
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

            if ($score >= 7) {
                $risk = 'tinggi';
            } elseif ($score >= 5) {
                $risk = 'sedang';
            } else {
                $risk = 'rendah';
            }

            
           try {

                \Log::info($request->all());

                $screening = TbcScreening::create([
                    'user_id' => 1,

                    'is_self_screening' =>
                        $request->is_self_screening ? 1 : 0,

                    'pelapor_nama' =>
                        $request->pelapor_nama,

                    'pelapor_kelompok' =>
                        $request->pelapor_kelompok,

                    'pelapor_instansi' =>
                        $request->pelapor_instansi,

                    'pelapor_no_telp' =>
                        $request->pelapor_no_telp,

                    'pelapor_nik' =>
                        $request->pelapor_nik,

                    'bantu_lapor_nama' =>
                        $request->bantu_lapor_nama,

                    'bantu_lapor_nik' =>
                        $request->bantu_lapor_nik,

                    'nama_pasien' =>
                        $request->nama_pasien,

                    'nik_pasien' =>
                        $request->nik_pasien,
                    'status_risiko' =>
                        $risk,

                    'umur' => $request->umur,

                    'alamat' => $request->alamat,

                    'pekerjaan' => $request->pekerjaan,

                    'kabupaten' => $request->kabupaten,

                    'kecamatan' => $request->kecamatan,

                    'kelurahan' => $request->kelurahan,

                    'berat_badan' => $request->berat_badan,

                    'tinggi_badan' => $request->tinggi_badan,
                ]);


            } catch (\Exception $e) {

                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile(),
                ], 500);
            }

            // =========================
            // SIMPAN GEJALA
            // =========================
            foreach ($request->symptoms ?? [] as $symptom) {
                TbcScreeningSymptom::create([
                    'screening_id' => $screening->id,
                    'symptom_id'   => $symptom['id'],
                    'answer'       => $symptom['answer'],
                ]);
            }

            foreach ($request->answers ?? [] as $answer) {
                TbcAnswer::create([
                    'screening_id' => $screening->id,
                    'question_id'  => $answer['question_id'],
                    'answer'       => $answer['answer'],
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