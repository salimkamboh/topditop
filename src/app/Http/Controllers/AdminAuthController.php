<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminAuthController extends Controller
{
    public function apiAdminLogin(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => [
                        'message' => 'Bad credentials',
                        'status_code' => 401
                    ]
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Could not issue token',
                    'status_code' => 500
                ]
            ], 500);
        }
        $user = Auth::user();

        if (! $user->isAdmin()) {
            return response()->json([
                'error' => [
                    'message' => 'Forbidden',
                    'status_code' => 403
                ]
            ], 403);
        }

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function apiAdminCheck()
    {
        return response()->json([
            'user' => Auth::user(),
        ]);
    }
}
