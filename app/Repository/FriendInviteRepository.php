<?php

namespace App\Repository;

use App\Models\FriendInvite;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FriendInviteRepository extends AbstractRepository
{

    public function getModelClass(): string
    {
        return FriendInvite::class;
    }

    public function getSentFriendInvitesByUserId(int $userId): Collection
    {
        /** @var User $user */
        $user = User::find($userId);
        return $user->sentFriendInvites()->with(['invitee' => function ($query) {
            $query->select(['id', 'username']);
        }])->get();
    }

    public function getReceivedFriendInvitesByUserId(int $userId): Collection
    {
        /** @var User $user */
        $user = User::find($userId);
        return $user->pendingFriendInvites()->with(['user' => function ($query) {
            $query->select(['id', 'username']);
        }])->get();
    }

    public function setPending(int $inviteId, bool $pending): Model
    {
        $invite = FriendInvite::query()
            ->where('id', '=', $inviteId)
            ->where('is_pending', '=', !$pending)
            ->firstOrFail();

        $invite->update(
            [
                'is_pending' => $pending,
            ],
        );

        return $invite;
    }

    public function deleteInvite(int $inviteId): void
    {
        FriendInvite::find($inviteId)->delete();
    }
}
