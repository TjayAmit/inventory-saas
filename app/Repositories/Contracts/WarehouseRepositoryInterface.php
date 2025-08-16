<?php

namespace App\Repositories\Contracts;

use App\Data\WarehouseData;
use App\Models\Warehouse;

interface WarehouseRepositoryInterface
{
    public function create(array $data);
    public function findById(int $id);
    public function update(Warehouse $warehouse, WarehouseData $warehouseData);
    public function delete(Warehouse $warehouse);
}
