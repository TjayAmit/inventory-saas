<?php

namespace App\Services\Warehouse;

use App\Data\WarehouseData;
use App\Models\Warehouse;
use App\Repositories\Contracts\WarehouseRepositoryInterface;

class DeleteWarehouseService    
{
    public function __construct(
        private WarehouseRepositoryInterface $warehouseRepository
    ) {}

    public function handle(Warehouse $warehouse)
    {
        return $this->warehouseRepository->delete($warehouse);
    }
}
