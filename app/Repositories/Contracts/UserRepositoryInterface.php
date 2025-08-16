<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Data\UserData;
use App\Models\User;


interface UserRepositoryInterface
{
    public function index(Request $request):LengthAwarePaginator;
    public function create(UserData $userData): User;
    public function findByEmail(string $email): ?User;
    public function findById(int $id): ?User;
    public function update(User $user, UserData $userData): User;
    public function delete(User $user): bool;
}
