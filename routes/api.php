<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('api/register', [LoginController::class, 'register']);
Route::post('api/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->resource('api/users', UserController::class);
Route::middleware('auth:sanctum')->resource('api/calendars', CalendarController::class);
Route::middleware('auth:sanctum')->resource('api/events', EventController::class);
Route::middleware('auth:sanctum')->resource('api/tasks', TaskController::class);

Route::middleware('auth:sanctum')->get('api/logout', [LoginController::class, 'logout']);
