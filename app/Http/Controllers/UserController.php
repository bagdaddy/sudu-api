<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUser(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }

    public function view(int $id, UserService $userService): JsonResponse
    {
        try {
            return response()->json($userService->getById($id));
        } catch (Exception $e) {
            return response()->json([], 404);
        }
    }

    public function update(UpdateUserRequest $request, UserService $userService): JsonResponse
    {
        $data = $request->validated();

        try {
            $user = $userService->update(Auth::id(), $data);
        } catch (Exception $e) {
            return response()->json([], 400);
        }

        return response()->json(['user' => $user]);
    }
}
