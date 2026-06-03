<?php

namespace Modules\Ketenagakerjaan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ketenagakerjaan\app\Models\TrainingCenter;

class TrainingCenterController extends Controller
{
  
    public function index()
    {
        $data = TrainingCenter::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    
    public function show($id)
    {
        $center = TrainingCenter::with('trainings')->find($id);

        if (!$center) {
            return response()->json([
                'success' => false,
                'message' => 'Training center tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $center
        ]);
    }

}