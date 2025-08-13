<?php

namespace App\Services\Tenant;

use App\Data\TenantData;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Models\Tenant;

class UpdateTenantService
{
    public function __construct(
        private TenantRepositoryInterface $tenantRepository,
    ) {
    }
    public function handle(Tenant $tenant, TenantData $data): Tenant
    {
        return $this->tenantRepository->update($tenant, $data);
    }
}
