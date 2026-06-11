<?php

namespace Modules\Ketenagakerjaan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ketenagakerjaan\Models\JobTraining;

class JobTrainingController extends Controller
{
    // GET /api/sinaker/jobs
    public function index()
    {
        $jobs = JobTraining::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $jobs
        ]);
    }

    // GET /api/sinaker/jobs/{id}
    public function show($id)
    {
        $job = JobTraining::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $job
        ]);
    }
}