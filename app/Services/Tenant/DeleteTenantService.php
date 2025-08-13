<?php

namespace App\Services\Tenant;

use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Models\Tenant;

class DeleteTenantService
{
    public function __construct(
        private TenantRepositoryInterface $tenantRepository,
    ) {
    }
    public function handle(Tenant $tenant): void
    {
        $this->tenantRepository->delete($tenant);
    }
}
