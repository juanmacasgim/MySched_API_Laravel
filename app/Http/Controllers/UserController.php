<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse as HttpJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse{
        return response()->json(User::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):JsonResponse{
        $user = User::create($request->validated());
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'User not created',
            ], 400);
        }
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'User found',
            'data' => $user
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
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
        $user->update($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
            'data' => $user
        ], 200);
    }
}
