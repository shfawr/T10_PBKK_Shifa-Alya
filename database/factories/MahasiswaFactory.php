<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'nrp' => '5025' . fake()->numerify('######'),
            'departemen' => fake()->randomElement([
                'Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer',
            ]),
            'is_active' => fake()->boolean(85),
        ];
    }
}
