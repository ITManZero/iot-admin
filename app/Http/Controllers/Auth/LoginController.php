<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;


class LoginController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => "Unauthorized"], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
            'payload' => auth()->user()
        ]);

    }

    public function logout(): JsonResponse
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => "The token is invalid"], 400);
        } else
            auth()->logout();

        return response()->json([
            'success' => true,
            'user' => $user
        ]);
    }
}
