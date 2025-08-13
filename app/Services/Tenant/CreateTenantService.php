<?php

namespace App\Services\Tenant;

use App\Data\TenantData;
use App\Models\Tenant;

class CreateTenantService
{
    public function handle(TenantData $data): Tenant
    {
        return Tenant::create([
            'name' => $data->name,
            'slug' => $data->slug,
            'is_active' => $data->is_active,
        ]);
    }
}
