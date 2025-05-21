<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class LoginController extends Controller
{
    public function register(UserRequest $request)
    {
        try {
            $user = User::create($request->validated());
        } catch (QueryException $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Email already registered',
            ], 400);
        }

        $token = $user->createToken('MySchedToken')->plainTextToken;

        return response()->json([
            'status' => 1,
            'message' => 'Register success',
            'data' => $user,
            'token' => $token,
        ], 201);
    }

    public function index()
    {
        return response()->json(User::all(), 200);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 1,
                'message' => 'Login success',
                'token' => $request->user()->createToken('MySchedToken')->plainTextToken
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'Invalid credentials provided',
        ], 403);
    }

    public function logout(Request $request)
    {
        if ($request->user()->currentAccessToken()->delete()) {
            return response()->json([
                'status' => 1,
                'message' => 'Logout success',
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Logout error',
        ], 401);
    }
}