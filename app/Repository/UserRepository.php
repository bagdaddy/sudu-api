<?php

namespace App\Repository;

use App\Dto\UserUpdate;
use App\Models\User;

class UserRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return User::class;
    }
}
