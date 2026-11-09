<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(RoleAndPermissionSeeder::class);

        $admin = User::factory()->create([
            'name'  => 'Admin PBKK',
            'email' => 'admin@pbkk.test',
        ]);
        $admin->assignRole('Admin');

        $staf = User::factory()->create([
            'name'  => 'Staf Akademik',
            'email' => 'staf@pbkk.test',
        ]);
        $staf->assignRole('Staf');

        //dummy buat di widget dashboard
        Mahasiswa::factory(50)->create();
        Dosen::factory(15)->create();
        Tugas::factory(25)->create();
    }
}
