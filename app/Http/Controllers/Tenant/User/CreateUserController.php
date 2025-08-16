<?php

namespace App\Http\Controllers\Tenant\User;

use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

use App\Services\User\CreateUserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Data\UserData;

final class CreateUserController extends Controller
{
    public function __construct(
        private CreateUserService $service,
    ) {}

    public function index()
    {
        return Inertia::render('Tenant/User/Create');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $this->service->handle(UserData::fromRequest($request));

        return redirect()->route('tenant.users.index');
    }
}
