<?php

namespace Modules\Pariwisata\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Pariwisata\Models\Facility;

class FacilityController extends Controller
{
    public function index()
    {
        try {

            $facilities = Facility::where('status', 'active')
                ->latest()
                ->get();

            return response()->json([
                'success' => true,
                'data' => $facilities,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ], 500);
        }
    }

    public function show($id)
    {
        $facility = Facility::with([
            'rooms',
            'reviews' => function ($query) {
                $query->where('status', 'approved')
                    ->latest();
            }
        ])->findOrFail($id);

        $facility->thumbnail_url = $facility->thumbnail
            ? asset('storage/facilities/' . $facility->thumbnail)
            : null;

        return response()->json([
            'success' => true,
            'data' => $facility,
        ]);
    }
}