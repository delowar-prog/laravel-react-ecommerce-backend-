<?php

namespace App\Http\Controllers;

use App\Enums\TokenAbility;
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
            'email' => 'required|email',
            'password' => 'required|min:6|max:20',
        ]);
    
        if (!Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated',
            ], 401);
        }
    
        $user = User::where('email', $request->email)->firstOrFail();
        $atExpireTime = now()->addMinutes(config('sanctum.expiration', 1)); // Default to 60 min
        $rtExpireTime = now()->addMinutes(config('sanctum.rt_expiration', 1440)); // Default to 1 day
    
        $accessToken = $user->createToken('access_token', [TokenAbility::ACCESS_API], $atExpireTime)->plainTextToken;
        $refreshToken = $user->createToken('refresh_token', [TokenAbility::ISSUE_ACCESS_TOKEN], $rtExpireTime)->plainTextToken;
    
        return response()->json([
            'status' => true,
            'user' => new UserResource($user),
            'tokens' => [
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
            ],
            'message' => 'User logged in successfully',
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
