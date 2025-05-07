<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        return response()->json(Event::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):JsonResponse
    {
        $event = Event::create($request->validated());
        if(!$event){
            return response()->json([
                'success' => false,
                'message' => 'Event not created',
            ], 400);
        }
        return response()->json([
            'success' => true,
            'message' => 'Event created successfully',
            'data' => $event
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        $event = Event::find($id);
        if(!$event){
            return response()->json([
                'success' => false,
                'message' => 'Event not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Event found',
            'data' => $event
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
        $event = Event::find($id);
        if(!$event){
            return response()->json([
                'success' => false,
                'message' => 'Event not found',
            ], 404);
        }
        $event->update($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully',
            'data' => $event
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        $event = Event::find($id);
        if(!$event){
            return response()->json([
                'success' => false,
                'message' => 'Event not found',
            ], 404);
        }
        $event->delete();
        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully',
        ], 200);
    }
}
