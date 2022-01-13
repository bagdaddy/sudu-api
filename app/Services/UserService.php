<?php

namespace App\Services;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository, AuthService $authService)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $fields): User
    {
        $fields['password'] = Hash::make($fields['password']);
        return $this->userRepository->createUser($fields);
    }
}
