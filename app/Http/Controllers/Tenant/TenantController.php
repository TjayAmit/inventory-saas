<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Data\TenantData;
use App\Exceptions\TenantExistException;
use App\Http\Requests\Tenant\TenantRequest;
use App\Models\Tenant;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

use App\Services\Tenant\CreateTenantService;
use App\Repositories\Contracts\TenantRepositoryInterface;
use Inertia\Inertia;

class TenantController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        protected TenantRepositoryInterface $tenantRepository,
        protected CreateTenantService $createTenantService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tenants = $this->tenantRepository->index($request);

        return Inertia::render('admin/tenants/index', [
            'tenants' => $tenants,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = $this->userRepository->list();

        return Inertia::render('admin/tenants/create', [
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TenantRequest $request)
    {
        $tenantData = TenantData::fromRequest($request);

        try{
            $tenant = $this->createTenantService->handle(auth()->user(), $tenantData);

            return redirect()
                ->route('tenant.index')
                ->with('success', 'Tenant created successfully');
        }catch(TenantExistException $e){
            return back()
                ->withInput()
                ->withErrors(['tenant' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}
