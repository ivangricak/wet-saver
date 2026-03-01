<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('login', $request->login)->first();

        // Якщо користувача немає або пароль не збігається
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Створюємо токен для extension
        $token = $user->createToken('extension-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'nick' => $user->nick,
                'login' => $user->login
            ]
        ]);
    }
}