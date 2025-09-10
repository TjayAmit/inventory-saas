<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'last_name' => "Amit",
            'first_name' => "Tristan",
            'name' => "Tristan Amit",
            'email' => 'tristan.zcmc@gmail.com',
            'password' => 'password',
            'email_verified_at' => now(),
            'address' => null
        ]);

        $admin->assignRole('Super Admin');

        $user = User::create([
            'last_name' => 'Doe',
            'first_name' => 'John',
            'name' => "John Doe",
            'email' => 'john@mailinator.com',   
            'password' => 'password',
            'email_verified_at' => now(),
            'address' => "Pasay, San Roque, Philippines"
        ]);

        $user->assignRole('Tenant Admin');
    }
}
