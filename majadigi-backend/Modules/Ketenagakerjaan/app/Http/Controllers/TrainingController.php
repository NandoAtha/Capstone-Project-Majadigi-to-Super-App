<?php

namespace Modules\Ketenagakerjaan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ketenagakerjaan\app\Models\Training;

class TrainingController extends Controller
{
    // GET /api/sinaker/trainings
    public function index()
    {
        $trainings = Training::with('center')->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $trainings
        ]);
    }

    // GET detail
    public function show($id)
    {
        $training = Training::with('center')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $training
        ]);
    }
}