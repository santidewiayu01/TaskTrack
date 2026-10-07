<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>
                \App\Models\User::factory(),
            'judul' => $this->faker->sentence(3),
            'deskripsi' => $this->faker->paragraph,
            'deadline' => $this->faker->dateTimeBetween('now','+1 month')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['belum','selesai']),
        ];
    }
}
