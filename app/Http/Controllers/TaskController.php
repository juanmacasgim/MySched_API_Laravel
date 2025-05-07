<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        return response()->json(Task::all(), 200);
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
        $task = Task::create($request->validated());
        if(!$task){
            return response()->json([
                'success' => false,
                'message' => 'Task not created',
            ], 400);
        }
        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'data' => $task
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        $task = Task::find($id);
        if(!$task){
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Task found',
            'data' => $task
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
        $task = Task::find($id);
        if(!$task){
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }
        $task->update($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'data' => $task
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        $task = Task::find($id);
        if(!$task){
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }
        $task->delete();
        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully',
        ], 200);
    }
}
