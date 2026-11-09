<?php

namespace Database\Factories;

use App\Models\Tugas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tugas>
 */
class TugasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => 'Tugas ' . fake()->sentence(3),
            'deskripsi' => fake()->paragraph(),
            'deadline' => fake()->dateTimeBetween('now', '+2 months'),
            'is_active' => fake()->boolean(75),
        ];
    }
}
