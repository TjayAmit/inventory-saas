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
            'image' => 'https://media.licdn.com/dms/image/v2/D5635AQGE_a0VLHkluA/profile-framedphoto-shrink_200_200/B56ZgL5m_mG0Ac-/0/1752546308431?e=1758117600&v=beta&t=RxwnQ4jAEk-Vv1_mZxTQMNF0aVF-jxCtpDO9CynYouI',
            'last_name' => "Amit",
            'first_name' => "Tristan",
            'email' => 'tristan.zcmc@gmail.com',
            'password' => 'password',
            'email_verified_at' => now(),
            'address' => null
        ]);

        $admin->assignRole('Super Admin');

        $user = User::create([
            'last_name' => 'Doe',
            'first_name' => 'John',
            'email' => 'john@mailinator.com',   
            'password' => 'password',
            'email_verified_at' => now(),
            'address' => "Pasay, San Roque, Philippines"
        ]);

        $user->assignRole('Tenant Admin');
    }
}
