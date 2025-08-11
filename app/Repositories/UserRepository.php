<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Data\UserData;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create(UserData $userData): User
    {
        return User::create($userData->toArray());
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function update(User $user, UserData $userData): User
    {
        $user->update($userData->toArray());

        return $user;
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
