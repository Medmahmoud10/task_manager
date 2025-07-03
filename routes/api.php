<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('tasks', TaskController::class);
Route::get('tasks/{id}/categories/profiles', [TaskController::class, 'getCategories']);
Route::apiResource('profiles', ProfileController::class);
Route::apiResource('tasks/{task_id}/categories', TaskController::class);