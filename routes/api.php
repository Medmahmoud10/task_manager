<?php

use App\Http\Controllers\categoriescontroller;
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
Route::apiResource('profiles', ProfileController::class);
Route::apiResource('profiles.tasks', TaskController::class)->shallow();
Route::apiResource('tasks.categorie_task', TaskController::class);
Route::apiResource('tasks.categories', TaskController::class)->only(['index']);
Route::post('registre', [UserController::class, 'Registre']);
Route::post('Login', [UserController::class, 'Login']); 
Route::post('Logout', [UserController::class, 'Logout'])->middleware('auth:sanctum');











// Route::apiResource('profiles.tasks', ProfileController::class) // Profile-task relationships
//     ->only(['index', 'store']); // Category-task relationships
// Route::apiResource('categories.tasks', categoriescontroller::class)
//     ->only(['index']);  // GET /categories/{category}/tasks