<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Profiler\Profile;

class userController extends Controller
{
    public function Registre(Request $request)
    {
        // Validate the request data (checks both 'users' and 'profiles' tables)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email'),       // Check 'users' table
                Rule::unique('profiles', 'email'),    // Check 'profiles' table
            ],
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user (use $validated instead of $request)
        $user = User::create([
            'username' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }

    public function Login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);


        if (!Auth::attempt($request->only('email', 'password')))
            return response()->json(
                [
                    'message' => 'invalid email or password ',
                ],
                401
            );
        $user = User::where('email', $request->email)->FirstOrFail();
        $token   = $user->createToken('auth_Token')->plainTextToken;
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ], 200);
    }


    public function Logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successfully',
        ], 200);
    }
}
