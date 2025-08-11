<?php

namespace App\Services\User;

use App\Data\UserData;
use App\Repositories\Contracts\UserRepositoryInterface;

class CreateUserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {}

    public function handle(UserData $userData): void
    {
        $this->userRepository->create($userData);
    }
}
