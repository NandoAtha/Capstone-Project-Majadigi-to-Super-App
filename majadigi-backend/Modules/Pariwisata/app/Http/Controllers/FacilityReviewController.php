<?php

namespace Modules\Pariwisata\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Pariwisata\Models\Facility;
use Modules\Pariwisata\Models\FacilityReview;
use Modules\Pariwisata\Models\FacilityRoom;

class FacilityReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($facilityId)
    {
        $reviews = FacilityReview::where(
            'facility_id',
            $facilityId
        )
        ->where('status', 'approved')
        ->latest()
        ->get();

        return response()->json([
            'success' => true,
            'data' => $reviews
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pariwisata::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $facilityId)
    {
        try {

            $facility = Facility::findOrFail($facilityId);

            $user = auth()->user();

            $review = FacilityReview::create([
                'facility_id' => $facility->id,
                'full_name' => $user?->name ?? 'Guest',
                'rating' => $request->rating,
                'review' => $request->review,
                'status' => 'approved'
            ]);

            return response()->json([
                'success' => true,
                'data' => $review
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }

    private function updateRating(Facility $facility)
    {
        $reviews = $facility->reviews()
            ->where('status', 'approved');

        $facility->update([
            'average_rating' => round(
                $reviews->avg('rating') ?? 0,
                2
            ),
            'total_reviews' => $reviews->count()
        ]);
    }
    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('pariwisata::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('pariwisata::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
