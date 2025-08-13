<?php

namespace App\Repositories\Contracts;

use App\Data\TenantData;
use App\Models\Tenant;

interface TenantRepositoryInterface
{
    public function create(TenantData $data): Tenant;

    public function findById(int $id): ?Tenant;
    public function findBySlug(string $slug): ?Tenant;
    public function update(Tenant $tenant, TenantData $data): Tenant;
    public function delete(Tenant $tenant): bool;
}
