<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalendarRequest;
use App\Models\Calendar;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        /** @var \Illuminate\Contracts\Auth\Guard $auth */
        $auth = auth();
        $userId = $auth->id();
        $calendars = Calendar::where('user_id', $userId)->get();

        return response()->json($calendars, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(CalendarRequest $request): JsonResponse
    {   
        /** @var \Illuminate\Contracts\Auth\Guard $auth */
        $auth = auth();
        try {
            $validatedData = $request->validated();
            $validatedData['user_id'] = $auth->id();

            $calendar = Calendar::create($validatedData);
        } catch (QueryException $e) {
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
    public function show(string $id): JsonResponse
    {   
        /** @var \Illuminate\Contracts\Auth\Guard $auth */
        $auth = auth();
        $calendar = Calendar::where('id', $id)
            ->where('user_id', $auth->id())
            ->first();

        if (!$calendar) {
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
    public function update(Request $request, string $id): JsonResponse
    {   
        /** @var \Illuminate\Contracts\Auth\Guard $auth */
        $auth = auth();
        $calendar = Calendar::where('id', $id)
            ->where('user_id', $auth->id())
            ->first();

        if (!$calendar) {
            return response()->json([
                'success' => false,
                'message' => 'Calendar not found',
            ], 404);
        }

        try {
            $calendar->update($request->all());
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Calendar not updated',
            ], 400);
        }
        return response()->json([
            'success' => true,
            'message' => 'Calendar updated successfully',
            'data' => $calendar
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {   
        /** @var \Illuminate\Contracts\Auth\Guard $auth */
        $auth = auth();
        $calendar = Calendar::where('id', $id)
            ->where('user_id', $auth->id())
            ->first();

        if (!$calendar) {
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
