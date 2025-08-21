<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

use App\Data\TenantData;
use App\Models\Tenant;
use App\Models\User;

interface TenantRepositoryInterface
{
    public function index(Request $request): LengthAwarePaginator;
    public function create(User $user, TenantData $tenantData): Tenant;
    public function findByOwnerAndName(User $user, string $name): ?Tenant;
}
