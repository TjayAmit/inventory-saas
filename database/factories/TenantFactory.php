<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => fake()->slug(),
            'domain' => fake()->domainName(),
            'logo' => fake()->imageUrl(),
            'favicon' => fake()->imageUrl(),
            'timezone' => fake()->timezone(),
            'currency' => fake()->currencyCode(),
            'language' => fake()->languageCode(),
            'is_active' => fake()->boolean(),
            'user_id' => User::factory(),
        ];
    }
}
