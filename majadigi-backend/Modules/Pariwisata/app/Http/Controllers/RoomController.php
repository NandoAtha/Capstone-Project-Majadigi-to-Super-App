<?php

namespace Modules\Pariwisata\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Pariwisata\Models\Facility;
use Modules\Pariwisata\Models\FacilityReview;
use Modules\Pariwisata\Models\FacilityRoom;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pariwisata::index');
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
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $room = FacilityRoom::with([
            'images',
            'facilities'
        ])->findOrFail($id);

        return response()->json($room);
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
