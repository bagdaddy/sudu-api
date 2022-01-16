<?php

namespace App\Http\Controllers;

use App\Http\Requests\FriendInvitationRequest;
use App\Services\FriendsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class FriendListController extends Controller
{
    public function getList(FriendsService $friendsService): JsonResponse
    {
        $response = $friendsService->getFriends();
        return response()->json($response);
    }

    public function sendInvite(FriendInvitationRequest $request, FriendsService $friendsService): JsonResponse
    {
        $fields = $request->validated();
        $friendsService->sendInvite($fields);

        return response()->json([]);
    }

    public function getSentRequests(FriendsService $friendsService): JsonResponse
    {
        $requests = $friendsService->getSentRequests();

        return response()->json($requests);
    }

    public function getPendingRequests(FriendsService $friendsService): JsonResponse
    {
        $requests = $friendsService->getPendingRequests();

        return response()->json($requests);
    }

    public function acceptInvite(int $id, FriendsService $friendsService): JsonResponse
    {
        try {
            $response = $friendsService->acceptFriendRequest($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => __('exceptions.invite_not_found')], 400);
        }

        return response()->json(['invite' => $response]);
    }
}
