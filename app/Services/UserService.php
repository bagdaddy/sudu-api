<?php

namespace App\Services;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository, AuthService $authService)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $fields): Model
    {
        $fields['password'] = Hash::make($fields['password']);
        return $this->userRepository->create($fields);
    }

    public function getById(int $id): Model
    {
        return $this->userRepository->getOneById($id);
    }

    /** return User|Model */
    public function update(int $userId, array $data): Model
    {
        return $this->userRepository->save($data, $this->getById($userId));
    }

    public function getAllUsers(int $currentId): Collection
    {
        return $this->userRepository->getAllUsers($currentId);
    }
}
