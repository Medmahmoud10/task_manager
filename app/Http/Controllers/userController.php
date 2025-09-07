<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{


    public function store(Request $request)
    {
        return $this->register($request);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'nullable|string|max:255',
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

    // After installing passport
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'username', 'password']);

        $field = filter_var($credentials['email'] ?? $credentials['username'], FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $authCredentials = [
            $field => $credentials[$field],
            'password' => $credentials['password']
        ];

        if (!Auth::attempt($authCredentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = User::find(Auth::id());
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        // FIXED: Include Role_id in the response
        $userData = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'role_id' => $user->role_id
        ];

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'user' => $userData,
            'message' => 'Login successful'
        ], 200);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ], 200);
    }



    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $currentUser = $request->user();
        $validated = $request->validate([
            'first_name' => 'string|max:255|required',
            'last_name' => 'string|max:255|required',
            'phone' => 'nullable|numeric|digits_between:1,20',
            'address' => 'string|nullable',
            'date_of_birth' => 'date|nullable',
            'bio' => 'string|nullable',
            'role_id' => 'sometimes|integer|exists:roles,id'
        ]);

        if (isset($request->role_id) && $currentUser->id != 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Only super admin can change user roles'
            ], 403);
        }

        try {
            // Find the user
            $user = User::findOrFail($id);

            // Update the user
            $user->update($validated);

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully',
                'user' => $user->load('role') // Load the role relationship
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update user: ' . $e->getMessage()
            ], 500);
        }

        $user->update($validated);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }
}
