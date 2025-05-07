<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * API Routes
 * This is where we define the routes of our API.
 * We can see the list of routes by running the command: php artisan route:list.
 */
/* Route::post('api/register', [LoginController::class, 'register']);
Route::post('api/login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->get('api/logout', [LoginController::class, 'logout']);

Route::middleware('auth:sanctum')->resource('api/wishes', WishController::class); */
//Route::resource('api/wishes', WishController::class);
/* Route::get('api/allusers', [LoginController::class, 'index']);
Route::get('api/allwishes', [WishController::class, 'index']); */

Route::resource('api/users', UserController::class);
Route::resource('api/calendars', CalendarController::class);
Route::resource('api/events', EventController::class);
Route::resource('api/tasks', TaskController::class);
