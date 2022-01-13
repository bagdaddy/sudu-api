<?php

namespace App\Services;

use App\Exceptions\LoginException;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws LoginException
     */
    public function login(array $credentials): array
    {
        if (Auth::attempt($credentials)) {
            $user = $this->userRepository->findById(Auth::id());
            return ['user' => auth()->user(), 'token' => $this->getUserAuthToken($user)];
        }

        throw new LoginException('Unauthorised Access', 401);
    }

    public function logout(User $user): void
    {
        $user->token()->revoke();
    }

    public function getUserAuthToken(User $user): string
    {
        return $user->createToken('appToken')->accessToken;
    }
}
