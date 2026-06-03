<?php

namespace Modules\Rsud\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Rsud\Models\HospitalRoom as Room;
use Modules\Rsud\Models\RoomCategory;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with('category')->get();

                return response()->json([
                    'success' => true,
                    'data' => $rooms
                ]);    
    }

    public function categories()
    {
        return response()->json([
            'success' => true,
            'data' => RoomCategory::all()
        ]);
    }

    public function byCategory($id)
    {
        $rooms = Room::with('category')
            ->where('room_category_id', $id)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $rooms
        ]);
    }

    public function availability()
{
    $total = Room::sum('total_beds');
    $occupied = Room::sum('occupied_beds');
    $available = $total - $occupied;

    return response()->json([
        'summary' => [
            'total_bed' => $total,
            'occupied_bed' => $occupied,
            'available_bed' => $available,
        ],
        'room_categories' => RoomCategory::all(),
        'data' => Room::with('category')->get(),
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rsud::create');
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
        return view('rsud::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('rsud::edit');
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
