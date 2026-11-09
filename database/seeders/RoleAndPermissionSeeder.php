<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = ['lihat-data', 'tambah-data', 'edit-data', 'hapus-data'];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // admin: akses penuh
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions($permissions);

        // staf: akses terbatas
        $staf = Role::firstOrCreate(['name' => 'Staf']);
        $staf->syncPermissions(['lihat-data', 'tambah-data']);
    }
}