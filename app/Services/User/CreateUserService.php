<?php

namespace App\Services\User;

use App\Data\UserData;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class CreateUserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {}

    public function handle(UserData $userData): User
    {
        return $this->userRepository->create($userData);
    }
}
