<?php

namespace App\Services\Tenant;

use App\Repositories\Contracts\TenantRepositoryInterface;

use App\Exceptions\TenantExistException;

use App\Data\TenantData;
use App\Models\Tenant;
use App\Models\User;

class CreateTenantService
{
    public function __construct(
        protected TenantRepositoryInterface $tenantRepository,
    ) {
    }

    public function handle(User $user, TenantData $tenantData): Tenant
    {
        $existingTenant = $this->tenantRepository->findByOwnerAndName($user, $tenantData->name);

        if ($existingTenant) {
            throw new TenantExistException();
        }

        $tenant = $this->tenantRepository->create($tenantData);
        $user->owner()->associate($tenant);
        $user->save();

        return $tenant;
    }
}
