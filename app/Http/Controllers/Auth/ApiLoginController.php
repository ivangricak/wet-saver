<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        try {

            // Валідація
            $request->validate([
                'login' => 'required|string',
                'password' => 'required|string'
            ]);

            Log::info('LOGIN ATTEMPT', [
                'login' => $request->login
            ]);

            $user = User::where('login', $request->login)->first();

            if (!$user) {
                Log::warning('USER NOT FOUND');
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }

            if (!Hash::check($request->password, $user->password)) {
                Log::warning('WRONG PASSWORD');
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }

            Log::info('USER AUTHENTICATED', [
                'user_id' => $user->id
            ]);

            // 🔥 Створення токена
            $token = $user->createToken('extension-token')->plainTextToken;

            Log::info('TOKEN CREATED');

            return response()->json([
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'nick' => $user->nick,
                    'login' => $user->login
                ]
            ]);

        } catch (\Exception $e) {

            Log::error('LOGIN ERROR: ' . $e->getMessage());

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}