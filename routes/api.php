<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Public routes (no authentication required)
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

// Test auth route
Route::middleware('auth:sanctum')->get('/test-auth', function () {
    return response()->json([
        'message' => 'Authenticated!',
        'user' => Auth::user()
    ]);
});

// User info endpoint
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = $request->user();
    
    // Load the role relationship
    $user->load('role');
    
    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'username' => $user->username,
        'first_name' => $user->first_name,
        'last_name' => $user->last_name,
        'role_id' => $user->role_id,
        'role' => $user->role->name,
        'is_admin' => $user->role->name === 'admin'
    ]);
});

// Web login route (optional)
Route::get('/login', function () {
    return response()->json([
        'message' => 'Please use the API login endpoint at /api/login',
        'api_login_url' => url('/api/login')
    ]);
})->name('login');

// Protected routes (require authentication)
Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::post('logout', [UserController::class, 'logout']);
    
    // TASKS ROUTES - All authenticated users can view
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/tasks/{id}', [TaskController::class, 'show']);
    
    // PROFILES ROUTES - All authenticated users can view
    Route::get('/profiles', [ProfileController::class, 'index']);
    Route::get('/profiles/{id}', [ProfileController::class, 'show']);
    
    // Allow users to update their own profiles (no admin role required)
    Route::put('/profiles/{id}', [ProfileController::class, 'update']);
    
    // CATEGORIES ROUTES - All authenticated users can view
    Route::get('/categories', [CategorieController::class, 'index']);
    Route::get('/categories/{id}', [CategorieController::class, 'show']);
    
    // Admin-only routes group
    Route::middleware(['role:admin'])->group(function () {
        
        // Admin tasks routes
        Route::post('/tasks', [TaskController::class, 'store']);
        Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
        Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus']);
        
        // Admin profiles routes (only create and delete require admin)
        Route::post('/profiles', [ProfileController::class, 'store']);
        Route::delete('/profiles/{id}', [ProfileController::class, 'destroy']);
        
        // Admin categories routes
        Route::post('/categories', [CategorieController::class, 'store']);
        Route::put('/categories/{id}', [CategorieController::class, 'update']);
        Route::delete('/categories/{id}', [CategorieController::class, 'destroy']);
        
        // Admin users routes (complete control)
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::patch('/users/{id}', [UserController::class, 'update']);
        Route::apiResource('users', UserController::class);
    });
    
    // Additional routes that don't require admin role but need authentication
    Route::put('/tasks/{id}', [TaskController::class, 'update']); // Allow users to update their own tasks
});
