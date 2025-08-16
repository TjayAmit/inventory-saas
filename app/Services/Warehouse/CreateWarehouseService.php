<?php

namespace App\Services\Warehouse;

use App\Data\WarehouseData;
use App\Repositories\Contracts\WarehouseRepositoryInterface;

class CreateWarehouseService
{
    public function __construct(
        private WarehouseRepositoryInterface $warehouseRepository
    ) {}

    public function handle(WarehouseData $warehouseData)
    {
        return $this->warehouseRepository->create($warehouseData->toArray());
    }
}
