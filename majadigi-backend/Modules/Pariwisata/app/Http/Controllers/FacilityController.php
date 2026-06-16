<?php

namespace Modules\Pariwisata\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Pariwisata\Models\Facility;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::where('status', 'active')
            ->latest()
            ->get()
            ->map(function ($facility) {

                $facility->thumbnail_url = $facility->thumbnail
                    ? asset('storage/facilities/' . $facility->thumbnail)
                    : null;

                return $facility;
            });

        return response()->json([
            'success' => true,
            'data' => $facilities,
        ]);
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