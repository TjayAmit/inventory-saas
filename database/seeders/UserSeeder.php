<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $user = User::create([
            'name' => 'Tenant',
            'email' => 'tenant@mailinator.com',
            'password' => 'password',
            'email_verified_at' => now(),

        ]);

        $user->assignRole('Tenant Admin');

        $admin = Admin::create([
            'name' => 'Tristan Jay Amit',
            'email' => 'tristan.zcmc@gmail.com',
            'password' => 'password',
            'is_super_admin' => true,
            'email_verified_at' => now(),
        ]);

        $admin->assignRole('Super Admin');
    }
}
