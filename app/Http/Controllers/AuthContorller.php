<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\ApiResponseService;
use Auth;
use Illuminate\Http\Request;

class AuthContorller extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|unique:users,email,except,id',
            'password' => 'required|min:6|max:20',
        ]);

        User::create($validated);

        return response()->json([
            'status' => 'Success',
            'message' => 'User registered successfully',
        ], 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required|min:6|max:20',
        ]);

        if(!Auth::attempt(['email' => $validated['email'], 'password' =>$validated['password']])){
            return response()->json([
                'status' => False,
                'message' => 'Unauthenticated',
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'user' => new UserResource($user),
            'token'  => $token,
            'message' => 'User Login successfully',
        ], 200);
    }
    public function user(Request $request)
    {
        $user = new UserResource($request->user());
        return ApiResponseService::success($user, 'User data retrieved successfully');
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

}
