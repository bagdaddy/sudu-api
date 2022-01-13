<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\LoginException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    public function register(RegisterRequest $request, UserService $userService, AuthService $authService): JsonResponse
    {
        $fields = $request->validated();

        try {
            $user = $userService->createUser($fields);
            $token = $authService->getUserAuthToken($user);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 400);
        }

        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function login(LoginRequest $request, AuthService $authService): JsonResponse
    {
        $fields = $request->validated();

        $loginCredentials = [
            'email' => $fields['email'],
            'password' => $fields['password'],
        ];

        try {
            $result = $authService->login($loginCredentials);
        } catch (LoginException $e) {
            return response()->json(['message' => __('auth.failed')], $e->getCode());
        }

        return response()->json($result);
    }

    public function logout(Request $request, AuthService $authService): JsonResponse
    {
        $authService->logout($request->user());

        return response()->json([]);
    }
}
