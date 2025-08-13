<?php

namespace App\Data;

use Illuminate\Http\Request;
use Spatie\LaravelData\Data;



class TenantData extends Data
{
    public function __construct(
        public string $name,
        public string $slug,
        public bool $is_active,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->name,
            slug: $request->slug,
            is_active: $request->is_active,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'is_active' => $this->is_active,
        ];
    }
}
