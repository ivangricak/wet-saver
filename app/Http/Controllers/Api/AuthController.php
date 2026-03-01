<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\Login\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Генеруємо токен для API
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'user' => [
                    'id' => $user->id,
                    'login' => $user->login,
                    'nick' => $user->nick,
                ],
                'token' => $token,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid login or password'
        ], 401);
    }
}