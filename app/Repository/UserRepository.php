<?php

namespace App\Repository;

use App\Dto\UserUpdate;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return User::class;
    }

    public function getAllUsers(int $currentId): Collection
    {
        return User::where('id', '!=', $currentId)->get();
    }
}
