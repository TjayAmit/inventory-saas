<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->sentence(3), 
            "message" => fake()->sentence(10),
            "type" => fake()->randomElement(["success", "error", "warning", "info"]),
            "action_url" => fake()->url(),
        ];
    }
}
