<?php

namespace App\Repository;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FeedRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return Post::class;
    }

    /**
     * @param int|string $id
     * @return Post|null
     */
    public function getOneById($id): ?Model
    {
        return parent::getOneById($id);
    }

    /**
     * @param array $ids
     * @return Builder[]|Collection
     */
    public function getByUserIds(array $ids): Collection
    {
        return Post::query()
            ->with(['likes', 'user', 'comments', 'pooPin', 'comments.user', 'likes.user'])
            ->whereIn('user_id', $ids)
            ->orderBy('created_at', 'desc')
            ->get()
        ;
    }

    /**
     * @param array $attributes
     * @return Post
     */
    public function create(array $attributes = []): Model
    {
        return parent::create($attributes);
    }
}
