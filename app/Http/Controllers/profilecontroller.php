<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @route GET /api/profiles
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $profiles = Profile::all();

            return response()->json([
                'success' => true,
                'data' => $profiles,
                'message' => 'Profiles retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve profiles',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     * 
     * @route GET /api/profiles/{id}
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        try {
            $profile = Profile::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $profile,
                'message' => 'Profile retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Profile not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Store a new profile.
     * 
     * @route POST /api/profiles
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UpdateProfileRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $profile = Profile::create($validated);

            return response()->json([
                'success' => true,
                'data' => $profile,
                'message' => 'Profile created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource.
     * 
     * @route PUT /api/profiles/{id}
     * @param UpdateProfileRequest $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProfileRequest $request, string $id): JsonResponse
{
    try {
        $profile = Profile::findOrFail($id);
        
        // Get the authenticated user
        $user = $request->user();
        
        // Authorization check: either admin or profile owner
        if (!$user->isAdmin() && $user->id !== $profile->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only update your own profile'
            ], 403);
        }
        
        $validated = $request->validated();
        $profile->update($validated);
        
        return response()->json([
            'success' => true,
            'data' => $profile,
            'message' => 'Profile updated successfully'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to update profile',
            'error' => $e->getMessage()
        ], 500);
    }
}

    /**
     * Remove the specified resource.
     * 
     * @route DELETE /api/profiles/{id}
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $profile = Profile::findOrFail($id);
            $profile->delete();

            return response()->json([
                'success' => true,
                'message' => 'Profile deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
