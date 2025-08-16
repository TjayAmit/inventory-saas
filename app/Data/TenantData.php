<?php

namespace App\Data;

use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class TenantData extends Data
{
    public function __construct(
        public string $name,
        public string $slug,
        public string $logo,
        public string $favicon,
        public string $timezone,
        public string $currency,
        public string $language,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->name,
            slug: $request->slug,
            logo: $request->logo,
            favicon: $request->favicon,
            timezone: $request->timezone,
            currency: $request->currency,
            language: $request->language,
            is_active: $request->is_active,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,  
            'slug' => $this->slug,
            'logo' => $this->logo,
            'favicon' => $this->favicon,
            'timezone' => $this->timezone,
            'currency' => $this->currency,
            'language' => $this->language,
            'is_active' => $this->is_active,
        ];
    }
}
