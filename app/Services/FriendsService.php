<?php

namespace App\Services;

use App\Models\FriendInvite;
use App\Repository\FriendInviteRepository;
use App\Repository\FriendsRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FriendsService
{
    private FriendsRepository $friendsRepository;
    private FriendInviteRepository $friendInviteRepository;
    public function __construct(FriendInviteRepository $friendInviteRepository, FriendsRepository $friendsRepository)
    {
        $this->friendInviteRepository = $friendInviteRepository;
        $this->friendsRepository = $friendsRepository;
    }

    public function sendInvite(array $fields): void
    {
        //@TODO: send invitation email
        $userId = Auth::id();
        $this->friendInviteRepository->create(
            [
                'user_id' => $userId,
                'invitee_id' => $fields['invitee_id'],
                'message' => $fields['message'],
            ]
        );
    }

    public function getSentRequests(): Collection
    {
        $userId = Auth::id();
        return $this->friendInviteRepository->getSentFriendRequestsByUserId($userId);
    }

    public function getPendingRequests(): Collection
    {
        $userId = Auth::id();
        return $this->friendInviteRepository->getReceivedFriendRequestsByUserId($userId);
    }

    public function acceptFriendRequest(int $inviteId): Model
    {
        $this->friendsRepository->addToFriends($inviteId);
        $res = $this->friendInviteRepository->setPending($inviteId, false);
        $this->friendInviteRepository->deleteInvite($inviteId);
        
        return $res;
    }

    public function getFriends(): Collection
    {
        return $this->friendsRepository->getFriendsByUserId(Auth::id());
    }

    public function deleteInvite(int $inviteId): void
    {
        $this->friendInviteRepository->deleteInvite($inviteId);
    }
    
    public function deleteFriend(int $friendId): void
    {
        $userId = Auth::id();
        $this->friendRepository->deleteFriend($friendId);
    }
}
