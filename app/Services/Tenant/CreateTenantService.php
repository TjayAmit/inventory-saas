<?php

namespace App\Services\Tenant;

use App\Data\TenantData;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Models\Tenant;

class CreateTenantService
{
    public function __construct(
        private TenantRepositoryInterface $tenantRepository,
    ) {
    }
    public function handle(TenantData $data): Tenant
    {
        return $this->tenantRepository->create($data);
    }
}
