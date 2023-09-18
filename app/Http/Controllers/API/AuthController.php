<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $expoToken = $request->input('expoToken') ?? null;
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($expoToken) {
                $user->expoToken = $expoToken;
                $user->save();
            }

            $token = $user->createToken('authToken')->plainTextToken;

            $member = $user->member;

            return response()->json([
                'token' => $token,
                'user' => $user,
                'member' => $member,
            ]);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
}