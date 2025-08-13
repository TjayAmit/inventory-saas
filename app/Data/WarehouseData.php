<?php

namespace App\Data;

use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class WarehouseData extends Data
{
    public int $tenantId;
    public string $name;
    public string $address;
    public bool $isDefault;

    public function __construct(
        int $tenantId,
        string $name,
        string $address,
        bool $isDefault
    ){
        $this->tenantId = $tenantId;
        $this->name = $name;
        $this->address = $address;
        $this->isDefault = $isDefault;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            tenantId: $request->tenantId,
            name: $request->name,
            address: $request->address,
            isDefault: $request->isDefault,
        );
    }

    public function toArray(): array
    {
        return [
            'tenantId' => $this->tenantId,
            'name' => $this->name,
            'address' => $this->address,
            'isDefault' => $this->isDefault,
        ];
    }
}