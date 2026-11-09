<?php

namespace Database\Factories;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => 'Dr. ' . fake()->name(),
            'nip' => '198' . fake()->numerify('##########'),
            'departemen' => fake()->randomElement([
                'Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer',
            ]),
        ];
    }
}
