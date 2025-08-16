<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Data\TenantData;
use App\Models\Tenant;
use App\Models\User;

class TenantRepository implements TenantRepositoryInterface
{
    public function index(User $user,Request $request): LengthAwarePaginator
    {
        return Tenant::where('user_id', $user->id)
            ->paginate(page: $request->query('page', 1), perPage: $request->query('per_page', 10));
    }
    public function create(TenantData $tenantData): Tenant
    {
        return Tenant::create($tenantData->toArray());
    }

    public function findByOwnerAndName(User $user, string $name): ?Tenant
    {
        return Tenant::where('user_id', $user->id)
            ->where('name', $name)
            ->first();
    }
}
