<?php

namespace Modules\Pariwisata\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Pariwisata\Models\Booking;
use Modules\Pariwisata\Models\BookingFacility;

class BookingController extends Controller
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
    public function store(Request $request)
{
    $request->validate([
        'facility_room_id' => 'required',
        'full_name' => 'required',
        'booking_date' => 'required|date',
        'session' => 'required',
    ]);

    $booking = Booking::create([
        'booking_code' =>
            'BK-' . now()->format('YmdHis'),

        'facility_room_id' =>
            $request->facility_room_id,

        'full_name' =>
            $request->full_name,

        'phone' =>
            $request->phone,

        'email' =>
            $request->email,

        'booking_date' =>
            $request->booking_date,

        'session' =>
            $request->session,

        'notes' =>
            $request->notes,
    ]);

    if ($request->filled('facilities')) {

        foreach ($request->facilities as $facilityId) {

            BookingFacility::create([
                'booking_id' => $booking->id,
                'room_facility_id' => $facilityId
            ]);
        }
    }

    return response()->json([
        'message' => 'Booking berhasil',
        'data' => $booking
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
