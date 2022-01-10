<?php

namespace App\Services;

use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $fields)
    {
        $fields['password'] = Hash::make($fields['password']);
        $user = $this->userRepository->createUser($fields);
        return ['user' => $user, 'token' => $user->createToken('appToken')->accessToken];
    }
}
