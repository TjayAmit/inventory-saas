<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Data\AdminDto;
use App\Models\Admin;

class AdminRepository implements AdminRepositoryInterface
{
    public function create(AdminDto $adminDto): Admin
    {
        return Admin::create($adminDto->toArray());
    }

    public function revoke(Admin $admin): bool
    {
        return $admin->update(['is_active' => false]);
    }

    public function update(Admin $admin, AdminDto $adminDto): Admin
    {
        $admin->update($adminDto->toArray());
        
        return $admin;
    }

    public function delete(Admin $admin): bool
    {
        return $admin->delete();
    }
}