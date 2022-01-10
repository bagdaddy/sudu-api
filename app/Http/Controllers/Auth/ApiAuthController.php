<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    public function register(RegisterRequest $request, UserService $userService): JsonResponse
    {
        $fields = $request->validated();

        try {
            $result = $userService->createUser($fields);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 400);
        }

        return response()->json($result);
    }
}
