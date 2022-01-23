<?php

namespace App\Repository;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class CommentRepository extends AbstractRepository
{

    public function getModelClass(): string
    {
        return Comment::class;
    }

    /**
     * @param int|string $id
     * @return Comment|null
     */
    public function getOneById($id): ?Model
    {
        return parent::getOneById($id);
    }

    /**
     * @param array $data
     * @param Model|null $model
     * @return Comment
     */
    public function save(array $data, ?Model $model = null): Model
    {
        return parent::save($data);
    }
}
