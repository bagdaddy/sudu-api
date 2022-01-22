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

    public function getSentInvites(FriendsService $friendsService): JsonResponse
    {
        $invites = $friendsService->getSentInvites();

        return response()->json($invites);
    }

    public function getPendingInvites(FriendsService $friendsService): JsonResponse
    {
        $invites = $friendsService->getPendingInvites();

        return response()->json($invites);
    }

    public function acceptInvite(int $id, FriendsService $friendsService): JsonResponse
    {
        try {
            $response = $friendsService->acceptFriendInvite($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => __('exceptions.invite_not_found')], 400);
        }

        return response()->json(['invite' => $response]);
    }

    public function deleteInvite(int $inviteId, FriendsService $friendsService): JsonResponse
    {
        try {
            $friendsService->deleteInvite($inviteId);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => __('exceptions.invite_not_found')], 400);
        }

        return response()->json();
    }

    public function deleteFriend(int $friendId, FriendsService $friendsService): JsonResponse
    {
        try {
            $friendsService->deleteFriend($friendId);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => __('exceptions.friend_not_found')], 400);
        }

        return response()->json();
    }
}
