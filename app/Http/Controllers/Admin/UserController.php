<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(page: 1, perPage: 10);

        return Inertia::render('admin/users/index', [
            'users' => $users,
        ]);
    }


}
