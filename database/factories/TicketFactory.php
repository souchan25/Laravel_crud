<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(3),
            'status' => fake()->randomElement(['open', 'in-progress', 'resolved']),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'type' => fake()->randomElement(['bug', 'feature']),
            'user_id' => User::factory(),
            'assignee_id' => fake()->boolean(70) ? User::factory() : null,
        ];
    }
}
