<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(UserRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = User::create($validated);
        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (!auth()->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json(['token' => $token]);
    }
}
