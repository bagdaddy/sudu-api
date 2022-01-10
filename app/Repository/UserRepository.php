<?php

namespace App\Repository;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $fields)
    {
        return User::create([
            'nickname' => $fields['nickname'],
            'email' => $fields['email'],
            'password' => $fields['password'],
        ]);
    }
}
