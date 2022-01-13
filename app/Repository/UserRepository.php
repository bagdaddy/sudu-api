<?php

namespace App\Repository;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $fields)
    {
        return User::create([
            'username' => $fields['username'],
            'email' => $fields['email'],
            'password' => $fields['password'],
        ]);
    }

    public function findById(int $id)
    {
        return User::find($id);
    }
}
