<?php

namespace App\Services\User;

use App\Data\UserData;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CreateUserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {}

    public function handle(UserData $userData): User
    {
        return DB::transaction(function () use ($userData) {
            $user = $this->userRepository->create($userData);

            $this->notify($user);

            return $user;
        });
    }

    protected function notify(User $user)
    {
        
    }
}
