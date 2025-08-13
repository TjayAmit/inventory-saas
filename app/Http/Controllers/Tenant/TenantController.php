<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Http\Requests\TenantRequest;
use App\Services\Tenant\CreateTenantService;
use App\Services\Tenant\DeleteTenantService;
use App\Services\Tenant\UpdateTenantService;
use Inertia\Inertia;
use App\Data\TenantData;

class TenantController extends Controller
{
    public function __construct(
        private CreateTenantService $createTenantService,
        private UpdateTenantService $updateTenantService,
        private DeleteTenantService $deleteTenantService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::all();
        return Inertia::render('Tenant/Index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Tenant/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TenantRequest $request)
    {
        $data = TenantData::fromRequest($request);

        $tenant = $this->createTenantService->handle($data);

        return redirect()->route('tenant.index')->with('success', 'Tenant created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        return Inertia::render('Tenant/Show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        return Inertia::render('Tenant/Edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TenantRequest $request, Tenant $tenant)
    {
        $data = TenantData::fromRequest($request);

        $tenant = $this->updateTenantService->handle($tenant, $data);

        return redirect()->route('tenant.index')->with('success', 'Tenant updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $this->deleteTenantService->handle($tenant);

        return redirect()->route('tenant.index')->with('success', 'Tenant deleted successfully');
    }
}
