<?php

namespace App\Services\Warehouse;

use App\Data\WarehouseData;
use App\Models\Warehouse;
use App\Repositories\Contracts\WarehouseRepositoryInterface;

class UpdateWarehouseService
{
    public function __construct(
        private WarehouseRepositoryInterface $warehouseRepository
    ) {}

    public function handle(WarehouseData $warehouseData, Warehouse $warehouse)
    {
        return $this->warehouseRepository->update($warehouse, $warehouseData);
    }
}
