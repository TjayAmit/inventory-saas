<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->index($request);

        return Inertia::render('admin/users/index', [
            'users' => $users,
        ]);
    }

    public function store(UserRequest $request)
    {
        
        
    }
}
