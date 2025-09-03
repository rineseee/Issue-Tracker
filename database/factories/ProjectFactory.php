<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'start_date' => $this->faker->date(),
            'deadline' => $this->faker->dateTimeBetween('now', '+6 months'),
            'user_id' => User::factory(),

        ];
    }
}
