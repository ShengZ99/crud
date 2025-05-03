<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Create a user
Route::post('/users/create', [UserController::class, 'create']);

// List of users
Route::get('/users', [UserController::class, 'index']);

// User detail
Route::get('/users/{id}', [UserController::class, 'show']);

// Delete user
Route::delete('/users/{id}', [UserController::class, 'destroy']);
