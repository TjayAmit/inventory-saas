<?php

namespace App\Repositories;

use App\Data\WarehouseData;
use App\Models\Warehouse;
use App\Repositories\Contracts\WarehouseRepositoryInterface;

class WarehouseRepository implements WarehouseRepositoryInterface
{
    public function create(array $data)
    {
        return Warehouse::create($data);
    }

    public function findById(int $id)
    {
        return Warehouse::find($id);
    }

    public function update(Warehouse $warehouse, WarehouseData $warehouseData)
    {
        return $warehouse->update($warehouseData->toArray());
    }

    public function delete(Warehouse $warehouse)
    {
        return $warehouse->delete();
    }
}