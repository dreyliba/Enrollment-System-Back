<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $token = auth()->user()->createToken('token')->accessToken;

            return response()->json([
                'code' => 200,
                'user' => auth()->user(),
                'token' => $token,
                'message' => 'Success',
            ]);
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'Invalid Username and Password'
            ], 401);
        };
    }
}
