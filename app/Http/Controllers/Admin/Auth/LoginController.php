<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function form()
    {
        return Inertia::render('admin/auth/login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return $this->sendFailedLoginResponse($request);
        }
        if (property_exists($admin, 'is_active') && !$admin->is_active) {
            return back()->withErrors([
                'email' => 'This account has been deactivated.',
            ]);
        }

        if (!$admin->email_verified_at) {
            return back()->withErrors([
                'email' => 'Please verify your email address first.',
            ]);
        }

        if (auth()->guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            \Log::info('Admin logged in successfully');
            return redirect()->intended('/admin/dashboard');
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return back()->withErrors([
            'email' => 'Invalid credentials. Please try again.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}