<?php

namespace App\Repository;

use App\Models\Like;

class LikesRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return Like::class;
    }

    public function exists(int $userId, int $postId): bool
    {
        return Like::query()
            ->where('user_id', '=', $userId)
            ->where('post_id', '=', $postId)
            ->exists()
        ;
    }

    public function delete(int $userId, $postId): void
    {
        Like::query()
            ->where('user_id', '=', $userId)
            ->where('post_id', '=', $postId)
            ->delete()
        ;
    }
}
