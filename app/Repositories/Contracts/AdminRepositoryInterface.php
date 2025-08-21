<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

use App\Data\AdminDto;
use App\Models\Admin;

interface AdminRepositoryInterface
{
    public function create(AdminDto $adminDto): Admin;
    public function update(Admin $admin, AdminDto $adminDto): Admin;
    public function revoke(Admin $admin): bool;
    public function delete(Admin $admin): bool;
}