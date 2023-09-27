<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;


class UserController extends Controller {
    public function signup(Request $request) { 
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:100|unique:users',
            'password' => 'required|confirmed|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User created successfully',
            'token' => $token,
        ]);
    }

    public function login(Request $request) {
        $user = User::where('username', $request->username)->firstOrFail();

        if (!Auth::attempt($request->only('username', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Logged in', 
            'token' => $token
        ]);
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
