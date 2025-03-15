<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OccupationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(3),
            'company_name' => $this->faker->company(),
            'salary_min' => $this->faker->numberBetween(30000, 60000),
            'salary_max' => $this->faker->numberBetween(60000, 120000),
            'is_remote' => $this->faker->boolean(),
            'job_type' => $this->faker->randomElement(['full-time', 'part-time', 'contract', 'freelance']),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'published_at' => now(),
        ];
    }
}
