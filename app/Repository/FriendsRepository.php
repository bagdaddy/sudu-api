<?php

namespace App\Repository;

use App\Models\Friend;
use App\Models\FriendInvite;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class FriendsRepository extends AbstractRepository
{

    public function getModelClass(): string
    {
        return Friend::class;
    }

    public function addToFriends(int $inviteId): void
    {
        $friends = FriendInvite::query()->where('id', '=', $inviteId)->where('is_pending', '=', true)->firstOrFail();
        Friend::create([
            'user_id' => $friends['user_id'],
            'friend_id' => $friends['invitee_id'],
        ]);

        Friend::create([
            'user_id' => $friends['invitee_id'],
            'friend_id' => $friends['user_id'],
        ]);
    }

    public function getFriendsByUserId(int $id): Collection
    {
        return User::find($id)->friends()->with('friend')->get();
    }
}
