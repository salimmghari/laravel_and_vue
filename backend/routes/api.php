<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\NoteController;


Route::post('/signup', [UserController::class, 'signup']);

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

Route::middleware('auth:sanctum')->resource('notes', NoteController::class);
