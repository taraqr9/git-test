<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(RegistrationRequest $request): JsonResponse
    {
        try {
            User::create($request->validated());

            return response()->json([
                'code' => 201,
                'message' => 'User registered successfully',
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            if (! $token = JWTAuth::attempt($request->validated())) {
                return response()->json([
                    'code' => 401,
                    'message' => 'Invalid credentials',
                ], 401);
            }

            return response()->json([
                'code' => 200,
                'token' => $token,
                'message' => 'Login successful',
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Could not create token',
            ], 500);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'code' => 200,
                'message' => 'Successfully logged out',
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Failed to logout, please try again',
            ], 500);
        }
    }

    public function profile(): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'message' => 'Unauthenticated',
                ], 401);
            }

            return response()->json([
                'code' => 200,
                'valid' => true,
                'user' => $user,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'valid' => false,
                'message' => 'Failed to fetch user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
