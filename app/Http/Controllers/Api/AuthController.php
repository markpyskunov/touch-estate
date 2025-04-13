<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\LogoutRequest;
use App\Http\Requests\Api\Auth\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Group;
use Spatie\RouteAttributes\Attributes\Post;

#[Group(prefix: 'api/v1/auth', as: 'api.v1.auth.')]
class AuthController extends Controller
{
    #[Post('login', name: 'login', middleware: 'guest')]
    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('auth-token')->accessToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }

    #[Post('logout', name: 'logout', middleware: 'auth:api')]
    public function logout(LogoutRequest $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([], 204);
    }

    #[Get('user', name: 'user', middleware: 'auth:api')]
    public function user(UserRequest $request): JsonResponse
    {
        return response()->json(new UserResource($request->user()));
    }
}
