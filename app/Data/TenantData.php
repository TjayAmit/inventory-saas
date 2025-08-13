<?php

namespace App\Data;

use App\Models\Tenant;

class TenantData
{
    public function __construct(
        public string $name,
        public string $slug,
        public bool $is_active,
    ) {
    }

    public static function fromTenant(Tenant $tenant): self
    {
        return new self(
            name: $tenant->name,
            slug: $tenant->slug,
            is_active: $tenant->is_active,
        );
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'is_active' => $this->is_active,
        ];
    }
}
