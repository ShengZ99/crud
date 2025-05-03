<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Show the list of users (web)
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Show user creation form (web)
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

// Store the new user (web)
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

// Show user edit form (web)
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

// Update user (web)
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

// Delete user (web)
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Bulk delete
Route::post('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulk-delete');



// API
// List of users
Route::get('api/users', [UserController::class, 'apiIndex']);

// Create a user
Route::post('api/users/create', [UserController::class, 'apiStore']);

// User detail
Route::get('api/users/{id}', [UserController::class, 'show']);

// Delete user
Route::delete('api/users/delete/{id}', [UserController::class, 'apiDestroy']);