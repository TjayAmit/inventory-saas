<?php

namespace App\Repositories;

use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Data\TenantData;
use App\Models\Tenant;

class TenantRepository implements TenantRepositoryInterface
{
    public function create(TenantData $data): Tenant
    {
        return Tenant::create([
            'name' => $data->name,
            'slug' => $data->slug,
            'is_active' => $data->is_active,
        ]);
    }

    public function findById(int $id): ?Tenant
    {
        return Tenant::find($id);
    }

    public function findBySlug(string $slug): ?Tenant
    {
        return Tenant::where('slug', $slug)->first();
    }

    public function update(Tenant $tenant, TenantData $data): Tenant
    {
        $tenant->update([
            'name' => $data->name,
            'slug' => $data->slug,
            'is_active' => $data->is_active,
        ]);

        return $tenant;
    }

    public function delete(Tenant $tenant): bool
    {
        return $tenant->delete();
    }
}
