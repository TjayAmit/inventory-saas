<?php



namespace App\Http\Controllers\Tenant\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\WarehouseRequest;
use App\Models\Warehouse;
use App\Services\Warehouse\CreateWarehouseService;
use App\Services\Warehouse\UpdateWarehouseService;
use App\Services\Warehouse\DeleteWarehouseService;
use Inertia\Inertia;

class WarehouseController extends Controller
{
    public function __construct(
        private CreateWarehouseService $createWarehouseService,
        private UpdateWarehouseService $updateWarehouseService,
        private DeleteWarehouseService $deleteWarehouseService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = Warehouse::all();
        return Inertia::render('Warehouse/Index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Warehouse/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarehouseRequest $request)
    {
        $this->createWarehouseService->handle($request->validated());

        return redirect()->route('tenant.warehouse.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        return Inertia::render('Warehouse/Show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        return Inertia::render('Warehouse/Edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WarehouseRequest $request, Warehouse $warehouse)
    {
        $this->updateWarehouseService->handle($request->validated(), $warehouse);

        return redirect()->route('tenant.warehouse.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        $this->deleteWarehouseService->handle($warehouse);

        return redirect()->route('tenant.warehouse.index');
    }
}
