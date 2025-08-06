<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($request->user()->id ?? null),
            ],
            'password' => 'required|string|min:8|confirmed',
            'first_name' => 'string|max:255|nullable',
            'last_name' => 'string|max:255|nullable', 
            'phone' => 'string|max:20|nullable',
            'address' => 'string|nullable',
            'date_of_birth' => 'date|nullable',
            'bio' => 'string|nullable'
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'first_name' => $validated['first_name'] ?? '',
            'last_name' => $validated['last_name'] ?? '',
            'phone' => $validated['phone'] ?? '',
            'address' => $validated['address'] ?? '',
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'bio' => $validated['bio'] ?? ''
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($validated)) {
            return response()->json([
                'message' => 'Invalid email or password',
            ], 401);
        }

        $user = User::where('email', $validated['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ], 200);
    }

    /**
     * Get all users
     * @return \Illuminate\Http\JsonResponse
     * 
     * @Route("GET /api/users", name="users.index")
     * @Route("GET /api/users", name="users.index", middleware=["auth:sanctum"])     * @response 200 {
     *   "users": [
     *     {
     *       "id": 1,
     *       "username": "john_doe",
     *       "email": "john@example.com",
     *       "first_name": "John",
     *       "last_name": "Doe"
     *     }
     *   ]
     * }
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    /**
     * Get single user by ID
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * 
     * @Route("GET /api/users/{id}", name="users.show")
     * 
     * @response 200 {
     *   "user": {
     *     "id": 1,
     *     "username": "john_doe", 
     *     "email": "john@example.com",
     *     "first_name": "John",
     *     "last_name": "Doe"
     *   }
     * }
     * @response 404 {
     *   "message": "User not found"
     * }
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user], 200);
    }

    /**
     * Update user
     * @param Request $request
     * @param int $id  
     * @return \Illuminate\Http\JsonResponse
     *
     * @Route("PUT /api/users/{id}", name="users.update")
     *
     * @response 200 {
     *   "message": "User updated successfully",
     *   "user": {
     *     "id": 1,
     *     "username": "john_doe_updated",
     *     "email": "john@example.com",
     *     "first_name": "John",
     *     "last_name": "Doe"
     *   }
     * }
     * @response 404 {
     *   "message": "User not found"
     * }
     * @response 422 {
     *   "message": "The given data was invalid",
     *   "errors": {
     *     "email": ["The email has already been taken."]
     *   }
     * }
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'username' => 'string|max:255',
            'email' => [
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'first_name' => 'string|max:255|nullable',
            'last_name' => 'string|max:255|nullable',
            'phone' => 'string|max:20|nullable',
            'address' => 'string|nullable',
            'date_of_birth' => 'date|nullable',
            'bio' => 'string|nullable'
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ], 200);
    }

    /**
     * Delete user
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @Route("DELETE /api/users/{id}", name="users.destroy")
     *
     * @response 200 {
     *   "message": "User deleted successfully"
     * }
     * @response 404 {
     *   "message": "User not found"
     * }
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }
}
