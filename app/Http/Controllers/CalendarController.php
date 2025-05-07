<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        return response()->json(Calendar::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):JsonResponse
    {
        $calendar = Calendar::create($request->validated());
        if(!$calendar){
            return response()->json([
                'success' => false,
                'message' => 'Calendar not created',
            ], 400);
        }
        return response()->json([
            'success' => true,
            'message' => 'Calendar created successfully',
            'data' => $calendar
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        $calendar = Calendar::find($id);
        if(!$calendar){
            return response()->json([
                'success' => false,
                'message' => 'Calendar not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Calendar found',
            'data' => $calendar
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):JsonResponse
    {
        $calendar = Calendar::find($id);
        if(!$calendar){
            return response()->json([
                'success' => false,
                'message' => 'Calendar not found',
            ], 404);
        }
        $calendar->update($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Calendar updated successfully',
            'data' => $calendar
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        $calendar = Calendar::find($id);
        if(!$calendar){
            return response()->json([
                'success' => false,
                'message' => 'Calendar not found',
            ], 404);
        }
        $calendar->delete();
        return response()->json([
            'success' => true,
            'message' => 'Calendar deleted successfully',
        ], 200);
    }
}
